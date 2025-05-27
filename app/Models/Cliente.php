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

    // Diga pro Laravel que esse campo é datetime:
    protected $casts = [
        'data_cadastro' => 'datetime',
    ];

    // Accessor para data_cadastro formatada
    public function getDataCadastroFormatadaAttribute()
    {
        if ($this->data_cadastro) {
            // Como agora é Carbon, não precisa do parse
            return $this->data_cadastro->format('d/m/Y H:i');
        }
        return '-';
    }
}
