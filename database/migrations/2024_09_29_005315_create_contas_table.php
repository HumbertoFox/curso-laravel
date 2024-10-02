<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cria a tabela contas_situacao
        Schema::create('contas_situacao', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cor');
            $table->timestamps();
        });

        // Cria a tabela contas
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->float('valor');
            $table->date('vencimento');
            $table->foreignId('situacao_conta_id')->default(2)->constrained('contas_situacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas');
        Schema::dropIfExists('contas_situacao');
    }
};