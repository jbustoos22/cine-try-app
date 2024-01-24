<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeliculaRequest;
use App\Models\Pelicula;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PeliculaController extends Controller
{
    function obtenerPeliculas()
    {
        $peliculas = Pelicula::all();

        return response()->json(['peliculas' => $peliculas]);
    }
    function obtenerPeliculasById($id)
    {
        $peliculas = Pelicula::find($id);

        return response()->json(['peliculas' => $peliculas]);
    }
    function index(int $idPelicula)
    {
        $pelicula = Pelicula::find($idPelicula);
        $fotoPath = Storage::url($pelicula->foto);
        return Inertia::render('Pelicula' , [
            'url' => $fotoPath
        ]);
    }
    function crearPeliculaIndex()
    {
        return Inertia::render('Auth/NewPelicula');
    }
    public function store(Request $request): RedirectResponse
    {
        // Obtener los datos del formulario
        $nombre = $request->input('nombre');
        $genero = $request->input('genero');
        $clase = $request->input('clase');
        $descripcion = $request->input('descripcion');
        $idioma = $request->input('idioma');
        $rutaImagen = null;  // Inicializar la variable $rutaImagen

        // Obtener y guardar la imagen en el servidor
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $rutaImagen = $imagen->store('public/images'); // Guardar la imagen en el directorio "storage/app/public/images"
        }
    
        // Crear un nuevo registro en la base de datos
        $pelicula = new Pelicula();
        $pelicula->nombre = $nombre;
        $pelicula->genero = $genero;
        $pelicula->clase = $clase;
        $pelicula->descripcion = $descripcion;
        $pelicula->idioma = $idioma;
        $pelicula->foto = $rutaImagen; // Guardar el nombre de la ruta de la imagen en la base de datos
        $pelicula->save();
    
        return redirect('dashboard');
    }
    
}
