<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\User;
use Illuminate\Http\Request;

class UserControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.users", [

            'users' => User::orderBy("id", "asc")->paginate(25)

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.update', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      $user=User::find($id);
      $user->username= $request->username;
      $user->email= $request->email;
      $user->save();
      return redirect("/users");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
            $user = User::find($id);
            Commentaire::where('id_user', $user->id)->delete();
            $user->delete();
            return redirect('/users')->with('success', 'User deleted successfully');

    }
    public function make($id)
    {
        $user=User::find($id);

      if ( $user->isadmin===0) {
        $user->isadmin=1;
        $user->save();
      } else {
        $user->isadmin=0;
        $user->save();
      }

      return redirect("/users");
    }

}
