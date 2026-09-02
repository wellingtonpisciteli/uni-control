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
        Schema::table('solicitacao_itens', function (Blueprint $table) {
            $table->unsignedInteger('quantidade_atendida')
                ->default(0)
                ->after('quantidade');

            $table->enum('status', [
                'pendente',
                'em_compra',
                'parcialmente_atendido',
                'atendido',
                'cancelado',
            ])
                ->default('pendente')
                ->after('quantidade_atendida');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitacao_itens', function (Blueprint $table) {
            $table->dropColumn([
                'quantidade_atendida',
                'status',
            ]);
        });
    }
};
