<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;

    protected $table = 'profissionais';

    protected $fillable = ['nome', 'especialidade'];

    /**
     * Relacionamento com agendamentos (1 profissional tem muitos agendamentos)
     * Ajuste o nome do Model e da chave estrangeira conforme seu projeto.
     */
    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'profissional_id');
    }
}
