<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Models\Portfolio;
use App\Models\CoreStack;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Rotas de Login
Route::get('/login', 
    [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', 
    [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', 
    [AuthController::class, 'logout'])->name('logout');


//Rotas Protegidas
Route::middleware('auth')->group(function() {
    Route::get('/admin', 
        [AdminController::class, 'index'])->name('admin');
    
    Route::post('/admin/update', 
        [AdminController::class, 'update'])->name('admin.update');

    Route::post('/admin/core-stack', 
        [AdminController::class, 'storeCoreStack'])->name('admin.core-stack.store');
    
    Route::delete('/admin/core-stack/{id}', 
        [AdminController::class, 'destroyCoreStack'])->name('admin.core-stack.destroy');

    Route::post('/admin/project', 
        [AdminController::class, 'storeProject'])->name('admin.project.store');
    
    Route::delete('/admin/project/{id}', 
        [AdminController::class, 'destroyProject'])->name('admin.project.destroy');

    Route::post('/admin/password', 
        [AdminController::class, 'updatePassword'])->name('admin.password.update');
});

// Rotas do portifolio
Route::get('/', function () {
    $portfolio = Portfolio::first();
    $coreStacks = CoreStack::all();
    $projects = Project::latest()->get();
    return view('portifolio', compact('portfolio', 'coreStacks', 'projects'));
})->name('portifolio');

// ROTA DE EMERGÊNCIA - RESET DE SENHA
Route::get('/reset-admin', function () {
    $user = \App\Models\User::where('email', 'j.vanz1108@gmail.com')->first();
    
    if (!$user) {
        // Caso o usuário não exista com esse email, vamos criar ou atualizar o primeiro que encontrar
        $user = \App\Models\User::first();
    }

    if ($user) {
        $user->update([
            'email' => 'j.vanz1108@gmail.com',
            'password' => bcrypt('julio123')
        ]);
        return "Senha do usuário " . $user->email . " resetada para: julio123";
    }

    return "Nenhum usuário encontrado no banco.";
});