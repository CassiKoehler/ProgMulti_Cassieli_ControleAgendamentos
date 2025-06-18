<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_servico',
        'descricao',
        'preco',
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'servico_id');
    }

}
