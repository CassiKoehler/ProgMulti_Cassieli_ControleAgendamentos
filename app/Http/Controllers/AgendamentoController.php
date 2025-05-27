<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Profissional;
use App\Models\Servico;
use Illuminate\Http\Request;
use App\Mail\AgendamentoCriadoMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AgendamentoController extends Controller
{
    public function index()
    {
        $agendamentos = Agendamento::with(['cliente', 'profissional', 'servico'])->get();
        $clientes = Cliente::all();
        $profissionais = Profissional::all();
        $servicos = Servico::all();

        return view('agendamentos.index', compact('agendamentos', 'clientes', 'profissionais', 'servicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'profissional_id' => 'required|exists:profissionais,id',
            'servico_id' => 'required|exists:servicos,id',
            'data_hora' => 'required|date',
            'status' => 'required|string|max:100',
            'observacao' => 'nullable|string',
        ]);

        $agendamento = Agendamento::create($request->all());

        // Enviar e-mail para o cliente
        if ($agendamento->cliente && $agendamento->cliente->email) {
            Mail::to($agendamento->cliente->email)->send(new AgendamentoCriadoMail($agendamento));
        }

        return redirect()->back()->with('success', 'Agendamento cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $clientes = Cliente::all();
        $profissionais = Profissional::all();
        $servicos = Servico::all();

        return view('agendamentos.edit', compact('agendamento', 'clientes', 'profissionais', 'servicos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'profissional_id' => 'required|exists:profissionais,id',
            'servico_id' => 'required|exists:servicos,id',
            'data_hora' => 'required|date',
            'status' => 'required|string|max:100',
            'observacao' => 'nullable|string',
        ]);

        $agendamento = Agendamento::findOrFail($id);
        $agendamento->update($request->all());

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();

        return redirect()->back()->with('success', 'Agendamento excluído com sucesso!');
    }

    // Tela do calendário
    public function painel()
    {
        return view('agendamentos.painel');
    }

    // Retorna os eventos em JSON para o FullCalendar
    public function eventos()
    {
        $agendamentos = Agendamento::with(['cliente', 'servico'])->get();

        $eventos = $agendamentos->map(function ($agendamento) {
            return [
                'id' => $agendamento->id,
                'title' => $agendamento->cliente->nome . ' - ' . $agendamento->servico->nome_servico,
                'start' => Carbon::parse($agendamento->data_hora)->format('Y-m-d\TH:i:s'),
                'end' => Carbon::parse($agendamento->data_hora)->addHour()->format('Y-m-d\TH:i:s'),
                'color' => $this->corPorStatus($agendamento->status),
            ];
        });

        return response()->json($eventos);
    }


    // Define cor do evento conforme o status
    private function corPorStatus($status)
    {
        return match ($status) {
            'confirmado' => '#28a745',   // verde
            'pendente' => '#ffc107',     // amarelo
            'cancelado' => '#dc3545',    // vermelho
            default => '#007bff',        // azul padrão
        };
    }
}
