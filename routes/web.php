<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Projects\ProjectsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/project/create', [ProjectsController::class, 'create'])->name('projects.create');
Route::get('/project/{id}', [ProjectsController::class, 'edit'])->name('projects.edit');
Route::post('/projects', [ProjectsController::class, 'store'])->name('projects.store');

Route::get('/profile', [ProjectsController::class, 'index'])->name('profile');