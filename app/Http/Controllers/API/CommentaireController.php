<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
        // On récupère tous les commentaires
        $commentaires = Commentaire::all();
        } catch (\Exception $e) {
            // En cas d'erreur, 
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

    // On retourne les informations des commentaires en JSON
    return response()->json($commentaires, 200);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
        // La validation de données
    $this->validate($request, [
        'url' => 'required|max:1000',
        'id_user' => 'required',
        'commentaire' => 'required|max:1000',
    ]);
        try {
    // On crée un nouveau commentaire
    $commentaire = Commentaire::create([
        'url' => $request->url,
        'id_user' => $request->id_user,
        'commentaire' => $request->commentaire
        
    ]);
    
    } catch (\Exception $e) {
        // En cas d'erreur,
        return response()->json(['error' => 'Internal Server Error'], 500);
    }

    // On retourne les informations du nouveau commentaire en JSON
    return response()->json($commentaire, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        // On retourne les informations du commentaire en JSON
    return response()->json($commentaire);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        try {
        // La validation de données
        $this->validate($request, [
        'commentaire' => 'required|max:1000',
    ]);

    $commentaire->update([
        'commentaire' => $request->commentaire,
        'url' => $request->url
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
    public function destroy(Commentaire $commentaire)
    {
        try {
        // On supprime le commentaire
    $commentaire->delete();
    } catch (\Exception $e) {
        // En cas d'erreur, renvoyer une réponse avec un statut de code 500 (erreur interne du serveur)
        return response()->json(['error' => 'Internal Server Error'], 500);
    }

    // On retourne la réponse JSON
    return response()->json(['message' => 'Comment deleted successfully']);
    }

    public function like(Request $request, Commentaire $commentaire){
        // verification de l'existance du like
        $liked = Like::where('id_user', auth()->user()->id)
        ->where('id_commentaire', $commentaire->id)
        ->first();

        if(! $liked){
            $like = new Like();
            $like ->id_user = auth()->user()->id;
            $like ->id_commentaire = $commentaire->id;
            $like->save();
        }
        else{
            $liked->delete();
        }
        // MIse à jour du nombre de likes
        $commentaire->updateLikeCount();

        return redirect()->back()->with('success', 'LIke ajouté');

    }
}
