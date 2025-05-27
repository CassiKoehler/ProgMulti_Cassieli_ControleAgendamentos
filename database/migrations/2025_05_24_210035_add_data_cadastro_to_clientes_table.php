<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataCadastroToClientesTable extends Migration
{
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->timestamp('data_cadastro')->nullable()->after('updated_at'); 
            // pode mudar 'after' para o campo que quiser — aqui coloquei depois do updated_at
        });
    }

    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('data_cadastro');
        });
    }
}
