<?php

use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/verSalas', [SalaController::class, 'obtenerSalas'])->name('salas.all');
Route::get('/obtainPeliculas', [PeliculaController::class, 'obtenerPeliculas'])->name('peliculas.all');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/salas', [SalaController::class, 'index'])->name('salas.ver');
    Route::get('/obtainSala/{id}', [SalaController::class, 'obtenerSalaById'])->name('salas.id');
    Route::get('/obtainPelicula/{id}', [PeliculaController::class, 'obtenerPeliculasById'])->name('peliculas.id');
    Route::get('/pelicula/{id}', [PeliculaController::class, 'index'])->name('pelicula.ver');
    Route::get('/sala/crear', [SalaController::class, 'crearSalaIndex'])->name('sala.nuevo');
    Route::get('/peliculas/crear', [PeliculaController::class, 'crearPeliculaIndex'])->name('pelicula.nuevo');
    Route::post('/sala/insertar', [SalaController::class, 'store'])->name('sala.crear');
    Route::post('/peliculas/insertar', [PeliculaController::class, 'store'])->name('pelicula.crear');

});

require __DIR__.'/auth.php';
