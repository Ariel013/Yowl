<?php

namespace App\Http\Controllers\API;
use App\Models\Commentaire;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->input('query');
        
        $commentaireQuery = Commentaire::query();

        if($query){
            $commentaireQuery -> where('commentaires.url', 'like', '%' . $query . '%')
                              ->orwhere('commentaires.commentaire', 'like', '%' . $query . '%');
        }

        $commentaires = $commentaireQuery->get();

        return view ('search', compact('commentaires'));
    }

}
