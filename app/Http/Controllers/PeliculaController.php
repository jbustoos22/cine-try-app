<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeliculaRequest;
use App\Models\Pelicula;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PeliculaController extends Controller
{
    function obtenerPeliculas()
    {
        $peliculas = Pelicula::all();

        // Modificar la ruta de la imagen para que sea accesible desde el cliente
        $peliculas->transform(function ($pelicula) {
            $fotoPath = Storage::url($pelicula->foto);
            $pelicula->foto_path = $fotoPath;
            return $pelicula;
        });

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

        return Inertia::render('Vista/Pelicula', [
            'url' => $fotoPath
        ]);
    }
    function crearPeliculaIndex()
    {
        return Inertia::render('Auth/NewPelicula');
    }

    function adminPeliculas()
    {
        return Inertia::render("Admin/AdminPeliculas", [
            'user' => auth()->user(), // Aquí estás pasando la información de sesión del usuario como una propiedad llamada 'user'
        ]);
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
        $color = $request->input('color');  // Inicializar la variable $rutaImagen

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
        $pelicula->color = $color; // Guardar el nombre de la ruta de la imagen en la base de datos
        $pelicula->save();

        return redirect('/admpelis');
    }

    public function update(Request $request, $id)
    {

        $nombre = $request->input('nombre');
        $genero = $request->input('genero');
        $clase = $request->input('clase');
        $descripcion = $request->input('descripcion');
        $idioma = $request->input('idioma');
        $rutaImagen = null;  // Inicializar la variable $rutaImagen
        $color = $request->input('color');  // Inicializar la variable $rutaImagen
        
        
        $registro = Pelicula::find($id);
        
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $rutaImagen = $imagen->store('public/images');
             // Guardar la imagen en el directorio "storage/app/public/images"
            $registro->foto = $rutaImagen; // Guardar el nombre de la ruta de la imagen en la base de datos
        }

        $registro->nombre = $nombre;
        $registro->genero = $genero;
        $registro->clase = $clase;
        $registro->descripcion = $descripcion;
        $registro->idioma = $idioma;
        $registro->color = $color; // Guardar el nombre de la ruta de la imagen en la base de datos
        $registro->save();
        return redirect('/admpelis');
    }
    public function destroy($id)
    {
        $registro = Pelicula::find($id);
        $registro->delete();
        return redirect('/admpelis');
    }

    public function updateView(int $id)
    {
        $pelicula = Pelicula::find($id);

        return Inertia::render('Auth/EditPelicula', [
            'pelicula' => $pelicula,
            'foto' => Storage::url($pelicula->foto)
        ]);
    }
}
