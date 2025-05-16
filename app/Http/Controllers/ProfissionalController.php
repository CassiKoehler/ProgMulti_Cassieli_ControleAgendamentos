<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use Illuminate\Http\Request;

class ProfissionalController extends Controller
{
    /**
     * Exibe a lista de profissionais.
     */
    public function index()
    {
        $profissionais = Profissional::all();
        return view('profissionais.index', compact('profissionais'));
    }

    /**
     * Armazena um novo profissional.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'especialidade' => 'required|string|max:255',
        ]);

        Profissional::create($request->all());

        return redirect()->back()->with('success', 'Profissional cadastrado com sucesso!');
    }

    /**
     * Exibe o formulário para editar um profissional.
     */
    public function edit($id)
    {
        $profissional = Profissional::findOrFail($id);
        return view('profissionais.edit', compact('profissional'));
    }

    /**
     * Atualiza os dados de um profissional.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'especialidade' => 'required|string|max:255',
        ]);

        $profissional = Profissional::findOrFail($id);
        $profissional->update($request->all());

        return redirect()->route('profissionais.index')->with('success', 'Profissional atualizado com sucesso!');
    }

    /**
     * Remove um profissional do sistema.
     */
    public function destroy($id)
    {
        $profissional = Profissional::findOrFail($id);
        $profissional->delete();

        return redirect()->back()->with('success', 'Profissional excluído com sucesso!');
    }
}
