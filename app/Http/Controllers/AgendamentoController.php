<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Profissional;
use App\Models\Servico;
use Illuminate\Http\Request;

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

        Agendamento::create($request->all());

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
}
