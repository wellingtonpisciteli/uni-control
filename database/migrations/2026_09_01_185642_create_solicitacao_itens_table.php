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
        Schema::create('solicitacao_itens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('solicitacao_id')
                ->constrained('solicitacoes')
                ->cascadeOnDelete();

            $table->foreignId('material_id')
                ->constrained('materiais')
                ->restrictOnDelete();

            $table->unsignedInteger('quantidade');

            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacao_itens');
    }
};
