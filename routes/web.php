<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\EstoqueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Perfil
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Usuários
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:administrador,lider'])->group(function () {

    Route::get('/usuarios', [UserController::class, 'index'])
        ->name('usuarios.index');

    Route::get('/usuarios/novo', [UserController::class, 'create'])
        ->name('usuarios.create');

    Route::post('/usuarios', [UserController::class, 'store'])
        ->name('usuarios.store');

    Route::get('/usuarios/{usuario}/editar', [UserController::class, 'edit'])
        ->name('usuarios.edit');

    Route::put('/usuarios/{usuario}', [UserController::class, 'update'])
        ->name('usuarios.update');

     Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])
        ->name('usuarios.destroy');

});


/*
|--------------------------------------------------------------------------
| Materiais e Estoque - Setores
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:setor,lider'])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Estoque
    |--------------------------------------------------------------------------
    */

    Route::get('/estoque', [EstoqueController::class, 'index'])
        ->name('estoque.index');


    // Entrada em lote
    Route::get('/estoque/entrada', [EstoqueController::class, 'entradaForm'])
        ->name('estoque.entrada.form');

    // Processar entrada em lote
    Route::post('/estoque/entrada', [EstoqueController::class, 'entradaLote'])
        ->name('estoque.entrada.lote');

    // Saída em lote
    Route::get('/estoque/saida', [EstoqueController::class, 'saidaForm'])
        ->name('estoque.saida.form');

    // Processar saída em lote
    Route::post('/estoque/saida', [EstoqueController::class, 'saidaLote'])
        ->name('estoque.saida.lote');


    // Entrada individual
    Route::post('/estoque/{material}/entrada', [EstoqueController::class, 'entrada'])
        ->name('estoque.entrada');


    // Saída individual
    Route::post('/estoque/{material}/saida', [EstoqueController::class, 'saida'])
        ->name('estoque.saida');


    /*
    |--------------------------------------------------------------------------
    | Materiais
    |--------------------------------------------------------------------------
    */

    Route::get('/materiais', [MaterialController::class, 'index'])
        ->name('materiais.index');

    Route::get('/materiais/create', [MaterialController::class, 'create'])
        ->name('materiais.create');

    Route::post('/materiais', [MaterialController::class, 'store'])
        ->name('materiais.store');

    Route::get('/materiais/{material}/edit', [MaterialController::class, 'edit'])
        ->name('materiais.edit');

    Route::put('/materiais/{material}', [MaterialController::class, 'update'])
        ->name('materiais.update');

    Route::delete('/materiais/{material}/desativar', [MaterialController::class, 'desativar'])
        ->name('materiais.desativar');

    Route::post('/materiais/{material}/reativar', [MaterialController::class, 'reativar'])
        ->name('materiais.reativar');

    Route::delete('/materiais/{material}', [MaterialController::class, 'destroy'])
        ->name('materiais.destroy');

});


/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';