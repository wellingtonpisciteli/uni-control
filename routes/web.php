<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstoqueController;


Route::get('/', function () {
    return view('welcome');
});

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
| Materiais - Setores
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:setor'])->group(function () {

    Route::get('/estoque', [EstoqueController::class, 'index'])
    ->middleware('auth')
    ->name('estoque.index');

    Route::get('/materiais', [MaterialController::class, 'index'])
        ->name('materiais.index');

    Route::get('/materiais/criar', [MaterialController::class, 'create'])
        ->name('materiais.create');

    Route::post('/materiais', [MaterialController::class, 'store'])
        ->name('materiais.store');

    Route::get('/materiais/create', [MaterialController::class, 'create'])
        ->name('materiais.create');

    Route::post('/materiais', [MaterialController::class, 'store'])
        ->name('materiais.store');

    Route::get('/materiais/{material}/edit', [MaterialController::class, 'edit'])
        ->name('materiais.edit');

    Route::put('/materiais/{material}', [MaterialController::class, 'update'])
        ->name('materiais.update');

    Route::delete('/materiais/{material}', [MaterialController::class, 'destroy'])
        ->name('materiais.destroy');

    Route::post('/materiais/{material}/reativar', [MaterialController::class, 'reativar'])
        ->name('materiais.reativar');

});


require __DIR__.'/auth.php';