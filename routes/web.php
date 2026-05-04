<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Models\Portfolio;
use App\Models\CoreStack;
use App\Models\Project;
use App\Models\Experience;
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
    
    Route::put('/admin/project/{id}', 
        [AdminController::class, 'updateProject'])->name('admin.project.update');

    Route::delete('/admin/project/{id}', 
        [AdminController::class, 'destroyProject'])->name('admin.project.destroy');

    Route::post('/admin/password', 
        [AdminController::class, 'updatePassword'])->name('admin.password.update');

    Route::post('/admin/experience', 
        [AdminController::class, 'storeExperience'])->name('admin.experience.store');

    Route::put('/admin/experience/{id}', 
        [AdminController::class, 'updateExperience'])->name('admin.experience.update');

    Route::delete('/admin/experience/{id}', 
        [AdminController::class, 'destroyExperience'])->name('admin.experience.destroy');
});

// Rotas do portifolio
Route::get('/', function () {
    $portfolio = Portfolio::query()->first();
    $coreStacks = CoreStack::all();
    $projects = Project::orderByDesc('created_at')->get();
    $experiences = Experience::orderBy('ordem', 'desc')->get();
    return view('portifolio', compact('portfolio', 'coreStacks', 'projects', 'experiences'));
})->name('portifolio');