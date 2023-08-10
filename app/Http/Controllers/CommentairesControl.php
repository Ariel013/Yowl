<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\User;
use Illuminate\Http\Request;

class CommentairesControl extends Controller
{
    public function index()
    {

        return view("admin/adminComment", [

            'commentaires' => Commentaire::orderBy("id", "asc")->paginate(25),


        ]);
    }
    public function destroy( $id)
    {
            $commentaire = Commentaire::find($id);
            $commentaire->delete();
            return redirect('/adminComment')->with('success', 'Comment deleted successfully');

    }
}
