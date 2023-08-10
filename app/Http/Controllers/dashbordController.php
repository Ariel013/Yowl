<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Like;

class dashbordController extends Controller
{
    
    public function index()
    {
        $likes = Like::join('commentaires', 'likes.id_commentaire', '=', 'commentaires.id')
                ->select('commentaires.commentaire')
                ->groupBy('id_commentaire')
                ->orderBy('commentaire', 'asc')
                ->limit(1)
                ->get();
        
        
        $commentaires= Commentaire::all();
        $a=0;
        $tab=[];
        $users = User::all();
        $mal =0;
        $fem=0;
        foreach ($users as $value) {
            if($value->sexe == "M"){
                $mal++;
            }
        };
        foreach ($users as $value) {
            if($value->sexe == "F"){
                $fem++;
            }
        };
        foreach ($commentaires as $value) {
            $tab[$value->url]=0;
            foreach ($commentaires as $commentaire) {
                if ($value->url === $commentaire->url) {
                    $tab[$value->url]++;
                }
            }
        };
        $max=0;
        $url="";
        foreach ($tab as $key => $value) {
           if ($max<=$value) {
           $max=$value;
           $url=$key;

           }
        }
        // dd($likes);
        return view('admin.dashboard', [
            'Nusers' => User::all()->count(),
             'Ncommentaires' => Commentaire::all()->count(),
             'Nmale' => $mal,
             'Nfem' => $fem,
              'max' =>$max,
              "url" =>$url,
              "likes" =>$likes
            ]);
    }
    
}
