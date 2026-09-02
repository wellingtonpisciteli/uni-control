<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('setores', function (Blueprint $table) {
            $table->foreign('unidade_id')
                ->references('id')
                ->on('unidades')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('setores', function (Blueprint $table) {
            $table->dropForeign(['unidade_id']);
        });
    }
};