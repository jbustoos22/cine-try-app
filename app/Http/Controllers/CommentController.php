<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Pelicula;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Auth/NewIgPost');
    }
    public function admComments()
    {
        return Inertia::render('Admin/AdminIg');
    }


    public function getComments()
    {
        $comment = Comment::all();

        return response()->json(['comment' => $comment]);
    }
    public function getCommentsId(int $id)
    {
        $comment = Comment::where('pelicula_id', $id)->get();

        return response()->json(['comment' => $comment]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Obtener los datos del formulario
        $peli_id = $request->input('pelicula_id');
        $html_code = $request->input('html_code');

        // Crear un nuevo registro en la base de datos
        $comment = new Comment();
        $comment->pelicula_id = $peli_id;
        $comment->html_code = $html_code;
        $comment->save();

        return redirect('/comment');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $pelicula_id = $request->input('pelicula_id');
        $html_code = $request->input('html_code');

        $registro = Comment::find($id);

        $registro->pelicula_id = $pelicula_id;
        $registro->html_code = $html_code;
        $registro->save();
        return redirect('/comment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registro = Comment::find($id);
        $registro->delete();
        return redirect('/comment');
    }
    public function updateView(int $id)
    {
        $comment = Comment::find($id);

        return Inertia::render('Auth/EditIgPost', [
            'comment' => $comment,
            'foto' => Storage::url($comment->foto)
        ]);
    }
    public function vvi()
    {
        return view('mail');
    }
    public function vvi2()
    {
        return view('success');
    }
}
