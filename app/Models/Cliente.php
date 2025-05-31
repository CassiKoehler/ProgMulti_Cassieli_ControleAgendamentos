<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'telefone', 'data_cadastro'];

    public $timestamps = false;

    protected $casts = [
        'data_cadastro' => 'datetime',
    ];

    public function getDataCadastroFormatadaAttribute()
    {
        return $this->data_cadastro 
            ? $this->data_cadastro->format('d/m/Y H:i') 
            : '-';
    }

    // Relacionamento com agendamentos (para regra de negócio da exclusão)
    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'cliente_id');
    }
}
