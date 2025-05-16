<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        $servicos = Servico::all();
        return view('servicos.index', compact('servicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_servico' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
        ]);

        Servico::create([
            'nome_servico' => $request->nome_servico,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
        ]);

        return redirect()->back()->with('success', 'Serviço cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $servico = Servico::findOrFail($id);
        return view('servicos.edit', compact('servico'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_servico' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
        ]);

        $servico = Servico::findOrFail($id);

        $servico->update([
            'nome_servico' => $request->nome_servico,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
        ]);

        return redirect()->route('servicos.index')->with('success', 'Serviço atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $servico = Servico::findOrFail($id);
        $servico->delete();

        return redirect()->back()->with('success', 'Serviço excluído com sucesso!');
    }
}
