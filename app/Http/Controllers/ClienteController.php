<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Carbon\Carbon;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $clientes = Cliente::when($busca, function ($query, $busca) {
            $query->where('nome', 'like', "%{$busca}%")
                ->orWhere('email', 'like', "%{$busca}%")
                ->orWhere('telefone', 'like', "%{$busca}%");
        })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clientes.index', compact('clientes'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'required|string|max:20|unique:clientes,telefone',
        ]);

        Cliente::create(array_merge(
            $request->all(),
            ['data_cadastro' => Carbon::now('America/Sao_Paulo')]
        ));

        return redirect()->back()->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefone' => 'required|string|max:20|unique:clientes,telefone,' . $cliente->id,
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        if ($cliente->agendamentos()->exists()) {
            return redirect()->back()->with('error', 'Não é possível excluir cliente com agendamentos vinculados.');
        }

        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
