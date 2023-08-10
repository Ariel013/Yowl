<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        // On récupère tous les likes
    $likes = Like::all();
    } catch (\Exception $e) {
        // En cas d'erreur
        return response()->json(['error' => 'Internal Server Error'], 500);
    }

    // On retourne les informations des likes en JSON
    return response()->json($likes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        // La validation de données
        $this->validate($request, [
            'like' => 'required',
        ]);

    // On crée un nouveau like
    $like = Like::create([
        'like' => $request->like,
    ]);
    } catch (\Exception $e) {
        // En cas d'erreur, 
        return response()->json(['error' => 'Internal Server Error'], 500);
    }

    return response()->json($like, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        
        return response()->json($like);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        try {
            $like->delete();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur suppression du like'], 500);
        }
        
            // On retourne la réponse JSON
            return response()->json(['message' => 'Like deleted successfully'], 200);
    }
}
