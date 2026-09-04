<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Temporariamente aceita os roles antigos e os novos
        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'administrador',
                'setor',
                'lider',
                'compras',
                'usuario_setor',
                'lider_setor',
                'usuario_compras',
                'lider_compras'
            ) NOT NULL DEFAULT 'usuario_setor'
        ");

        // 2. Converte os usuários existentes
        DB::table('users')
            ->where('role', 'setor')
            ->update(['role' => 'usuario_setor']);

        DB::table('users')
            ->where('role', 'lider')
            ->update(['role' => 'lider_setor']);

        DB::table('users')
            ->where('role', 'compras')
            ->update(['role' => 'usuario_compras']);

        // 3. Agora remove os roles antigos do ENUM
        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'administrador',
                'usuario_setor',
                'lider_setor',
                'usuario_compras',
                'lider_compras'
            ) NOT NULL DEFAULT 'usuario_setor'
        ");
    }

    public function down(): void
    {
        // 1. Permite temporariamente os dois conjuntos
        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'administrador',
                'setor',
                'lider',
                'compras',
                'usuario_setor',
                'lider_setor',
                'usuario_compras',
                'lider_compras'
            ) NOT NULL DEFAULT 'setor'
        ");

        // 2. Reverte os usuários
        DB::table('users')
            ->where('role', 'usuario_setor')
            ->update(['role' => 'setor']);

        DB::table('users')
            ->where('role', 'lider_setor')
            ->update(['role' => 'lider']);

        DB::table('users')
            ->where('role', 'usuario_compras')
            ->update(['role' => 'compras']);

        // 3. Volta para os roles antigos
        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'administrador',
                'setor',
                'lider',
                'compras'
            ) NOT NULL DEFAULT 'setor'
        ");
    }
};