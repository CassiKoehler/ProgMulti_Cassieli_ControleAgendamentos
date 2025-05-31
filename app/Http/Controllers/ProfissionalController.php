<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use Illuminate\Http\Request;

class ProfissionalController extends Controller
{
    /**
     * Exibe a lista de profissionais, com busca por nome.
     */
    public function index(Request $request)
    {
        $query = Profissional::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nome', 'like', "%{$search}%");
        }

        $profissionais = $query->get();

        return view('profissionais.index', compact('profissionais'));
    }

    /**
     * Armazena um novo profissional, validando campos e duplicidade.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'especialidade' => 'required|string|max:255',
        ]);

        // Verificar duplicidade nome + especialidade
        $existe = Profissional::where('nome', $request->nome)
            ->where('especialidade', $request->especialidade)
            ->exists();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['nome' => 'Já existe um profissional com este nome e especialidade.'])
                ->withInput();
        }

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
     * Atualiza os dados de um profissional, validando campos e duplicidade.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'especialidade' => 'required|string|max:255',
        ]);

        $profissional = Profissional::findOrFail($id);

        // Atualiza só a especialidade, ignorando o nome para garantir a regra
        $profissional->especialidade = $request->especialidade;
        $profissional->save();

        return redirect()->route('profissionais.index')->with('success', 'Profissional atualizado com sucesso!');
    }


    /**
     * Remove um profissional do sistema, apenas se não estiver vinculado a agendamentos.
     */
    public function destroy($id)
    {
        $profissional = Profissional::findOrFail($id);

        // Verificar se profissional está vinculado a agendamentos
        $temAgendamento = $profissional->agendamentos()->exists();

        if ($temAgendamento) {
            return redirect()->back()
                ->withErrors(['error' => 'Este profissional está vinculado a agendamentos e não pode ser excluído.']);
        }

        $profissional->delete();

        return redirect()->back()->with('success', 'Profissional excluído com sucesso!');
    }
}
