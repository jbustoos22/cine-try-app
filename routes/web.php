<?php

use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\CommentController;
use App\Mail\FacturaMailable;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Mail;
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
    Route::get('/salas', [SalaController::class, 'index'])->name('salas.ver');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/obtainPelicula/{id}', [PeliculaController::class, 'obtenerPeliculasById'])->name('peliculas.id');
    Route::get('/pelicula/{id}', [PeliculaController::class, 'index'])->name('pelicula.ver');
    Route::get('/peliculas/crear', [PeliculaController::class, 'crearPeliculaIndex'])->name('pelicula.nuevo');
    Route::get('/peliculas/actualizar/{id}', [PeliculaController::class, 'updateView'])->name('pelicula.updateView');
    Route::post('/peliculas/insertar', [PeliculaController::class, 'store'])->name('pelicula.crear');
    Route::post('/peliculas/update/{id}', [PeliculaController::class, 'update'])->name('pelicula.actualizar');
    Route::delete('/pelicula/destroy/{id}', [PeliculaController::class, 'destroy'])->name('pelicula.destroy');
    Route::get('/admpelis', [PeliculaController::class, 'adminPeliculas'])->name('pelicula.admin');
    Route::get('/sala/crear', [SalaController::class, 'crearSalaIndex'])->name('sala.nuevo');
    Route::get('/obtainSala/{id}', [SalaController::class, 'obtenerSalaById'])->name('salas.id');
    Route::post('/sala/insertar', [SalaController::class, 'store'])->name('sala.crear');
    Route::get('/admsalas', [SalaController::class, 'adminSalas'])->name('sala.admin');
    Route::get('/sala/editar', [SalaController::class, 'salaEdit'])->name('sala.admedit');
    Route::get('/sala/comprar', [SalaController::class, 'mapaAsientos'])->name('sala.mapa');
    Route::post('/comment/insertar', [CommentController::class, 'store'])->name('comment.crear');
    Route::get('/comment/crear', [CommentController::class, 'index'])->name('comment.nuevo');
    Route::get('/comment', [CommentController::class, 'admComments'])->name('comment.index');
    Route::get('/comment/get', [CommentController::class, 'getComments'])->name('comment.obtener');
    Route::get('/comment/get/{id}', [CommentController::class, 'getCommentsId'])->name('comment.obtenerid');
    Route::delete('/comment/destroy/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::get('/comment/actualizar/{id}', [CommentController::class, 'updateView'])->name('comment.updateview');
    Route::post('/comment/update/{id}', [CommentController::class, 'update'])->name('comment.update');

    Route::get('mail', function () {
        Mail::to('jaijo64@gmail.com')
            ->send(new FacturaMailable);
        return view('success');
    })->name('mail');

    Route::get('mailpreview', [CommentController::class, 'vvi'])->name('mailprev');
    Route::get('success', [CommentController::class, 'vvi2'])->name('success');
});

require __DIR__ . '/auth.php';
