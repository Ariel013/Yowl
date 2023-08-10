<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // On récupère tous les utilisateurs
    $users = User::all();

    // On retourne les informations des utilisateurs en JSON
    return response()->json($users, 200);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // La validation de données
    $validator = Validator::make($request->all(), [
        'username' => 'required|unique:users|regex:/^[\w\s-]+$/|max:100',
        'email' => 'required|email|unique:users|regex:/^.+@.+\..+$/i',
        'age' => 'required|integer|min:13|max:35',
        'sexe' => 'required',
        'password' => 'required|min:8'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // On crée un nouvel utilisateur
    try {
        $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'age' => $request->age,
        'sexe' => $request->sexe,
        'token'=>$request->token = Str::random(40),
        'password' => bcrypt($request->password)

    ]);


    $mailData = [
        'username' => $request->username,
        'email' => $request->email,
        'token' => $user->token, // Utilise l'ID de l'utilisateur comme jeton de confirmation
    ];

    Mail::to($mailData['email'])->send(new TestMail($mailData));

    } catch (\Exception $e) {
        return response()->json(['error' => "Erreur de création de user : $e" ], 500);
    }

    // On retourne les informations du nouvel utilisateur en JSON
    return response()->json($user, 201);
    // return redirect('/register')->with('status', 'Votre compte a été créé avec succès. Veuillez vérifier votre adresse e-mail pour la confirmation.');
}

    /**
     * Display the specified resource.
     */
    public function show(User $user)
{
    // On retourne les informations de l'utilisateur en JSON
    return response()->json($user, 200);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    // La validation de données
    $validator = Validator::make($request->all(), [
        'username' => 'required|unique:users|regex:/^[\w\s-]+$/|max:100',
        'email' => 'required|email|unique:users|regex:/^.+@.+\..+$/i',
        'status' => 'required',
        'password' => 'required|min:8'

    ]);
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }


    // On modifie les informations de l'utilisateur
    try {
    $user->update([
        "username" => $request->username,
        "email" => $request->email,
        'status' => $request->status,
        "password" => bcrypt($request->password)
    ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erreur modification user'], 500);
    }

    // On retourne la réponse JSON
    return response()->json(['message' => 'User updated successfully']);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
{
    // On supprime l'utilisateur
    try {
    $user->delete();
} catch (\Exception $e) {
    return response()->json(['error' => 'Erreur suppression du user'], 500);
}

    // On retourne la réponse JSON
    return response()->json(['message' => 'User deleted successfully'], 200);
}


public function confirmationMail($token)
    {
        // return view('welcome');
        $user = User::where('token', $token)->first();
        // dd($user);
        // return response()->json(['error' => 'Token de confirmation invalide'], 400);
        //vérifier si user a été trouvé
        if (!$user) {
            // Gérer le cas où l'utilisateur n'est pas trouvé
            return response()->json(['error' => 'Token de confirmation invalide'], 400);
        }
        //si il est déjà confirmé
        if ($user->status == 1) {
            return redirect('/')->with('status', 'Votre compte est déjà confirmé. Veuillez simplement vous connecter.');
        }
        //confimer le compte
        $user->status = 1;
        $user->token = ''; // Vous pouvez effacer le token une fois le compte confirmé
        $user->save();

        // $mailData['username'] = $user->username;
        // $mailData['email'] = $user->email;
        // $mailData['token'] = $user->token;

        return redirect('/')->with('status', 'Votre adresse e-mail est déjà confirmée. Vous pouvez maintenant vous connecter.');
    }

    public function searchByUsername(Request $request, $username)
    {
        $users = User::where('username', 'like', '%' . $username . '%')->get();

        return response()->json($users);
    }
}
