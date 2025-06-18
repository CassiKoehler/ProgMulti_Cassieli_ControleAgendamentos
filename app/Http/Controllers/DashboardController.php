<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Profissional;
use App\Models\Agendamento;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $clientesAtivos = Cliente::count();
        $profissionais = Profissional::count();
        $hoje = Carbon::today();
        $agendamentosHoje = Agendamento::whereDate('data_hora', $hoje)->count();

        return view('dashboard', compact('clientesAtivos', 'profissionais', 'agendamentosHoje'));
    }

    public function counts()
    {
        $clientesAtivos = Cliente::count();
        $profissionais = Profissional::count();
        $hoje = Carbon::today();
        $agendamentosHoje = Agendamento::whereDate('data_hora', $hoje)->count();

        return response()->json([
            'clientesAtivos' => $clientesAtivos,
            'profissionais' => $profissionais,
            'agendamentosHoje' => $agendamentosHoje,
        ]);
    }
}
