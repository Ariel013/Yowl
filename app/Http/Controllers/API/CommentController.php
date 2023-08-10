<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
        // On récupère tous les commentaires
        $comments = Comment::all();
    } catch (\Exception $e) {
        // En cas d'erreur, 
        return response()->json(['error' => 'Internal Server Error'], 500);
    }

    // On retourne les informations des commentaires en JSON
    return response()->json($comments, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        // La validation de données
    $this->validate($request, [
        'id_user' => 'required',
        'comment' => 'required|max:1000',
        'id_commentaire' => 'required',
    ]);

    // On crée un nouveau commentaire
    $comment = Comment::create([
        'comment' => $request->comment,
        'id_user' => $request->id_user,
        'id_commentaire' => $request->id_commentaire,
    ]);
    } catch (\Exception $e) {
        // En cas d'erreur, renvoyer une réponse avec un statut de code 500 (erreur interne du serveur)
        return response()->json(['error' => 'Internal Server Error'], 500);
    }

    // On retourne les informations du nouveau commentaire en JSON
    return response()->json($comment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        
        // La validation de données
        $this->validate($request, [
            'comment' => 'required|max:1000',
            'id_commentaire' => 'required',
        ]);
        
        try {
        $comment->update([
            'comment' => $request->comment,
            'id_commentaire' => $request->id_commentaire,
        ]);
        } catch (\Exception $e) {
            // En cas d'erreur, 
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    
    
        // On retourne la réponse JSON
         return response()->json(['message' => 'Comment updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        try {
       // On supprime le commentaire
    $comment->delete();
    } catch (\Exception $e) {
        // En cas d'erreur, renvoyer une réponse avec un statut de code 500 (erreur interne du serveur)
        return response()->json(['error' => 'Internal Server Error'], 500);
    }

    // On retourne la réponse JSON
    return response()->json(['message' => 'Comment deleted successfully']);
    }
}
