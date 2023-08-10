<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\TestMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Commentaire;


class ControlUser extends Controller
{
    public function from_register(Request $request)
    {
        if ($request->session()->get('utilisateur')) {
            return redirect('/userProfil')->with('status', 'Vous venez de vous déconnecter de cette session avant de vous inscrire');
        }
        return view('register');
    }
    public function from_login(Request $request)
    {
        if ($request->session()->get('utilisateur')) {
            return redirect('/userProfil')->with('status', 'Vous venez de vous déconnecter de cette session avant de vous connecter');
        }
        return view('login');
    }
    public function traitement_register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users|regex:/^[\w\s-]+$/|max:100',
            'email' => 'required|email|unique:users|regex:/^.+@.+\..+$/i',
            'age' => 'required|integer|min:13|max:35',
            'sexe' => 'required',
            'password' => 'required|min:4'

        ]);
        $password = $request->input('password');
        $passwordconf = $request->input('passwordconf');

        # Compare the passwords
        if ($password !== $passwordconf) {
            # The passwords don't match, so send an error message
            return redirect('/register')->with('status', 'Les mots de passe ne correspondent pas. Veuillez réessayer.');
        }

        $utilisateur = new User();
        $utilisateur->username = $request->input('username');
        $utilisateur->email = $request->input('email');
        $utilisateur->age = $request->input('age');
        $utilisateur->token = Str::random(40);
        $utilisateur->sexe = $request->input('sexe');
        $utilisateur->password = bcrypt($request->input('password'));
        $utilisateur->save();

        $mailData = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'token' => $utilisateur->token, // Utilise l'ID de l'utilisateur comme jeton de confirmation
        ];

        Mail::to($mailData['email'])->send(new TestMail($mailData));

        return redirect('/register')->with('status', 'Compte crée. confirmer le mail envoyé');
    }

    public function confirmationMail($token)
    {
        $utilisateur = User::where('token', $token)->first();

        if ($utilisateur) {
            // Vérifiez si le compte est déjà confirmé
            if ($utilisateur->status) {
                return redirect('/login')->with('status', 'Votre adresse e-mail est déjà confirmée. Vous pouvez maintenant vous connecter.');
            }

            // Mettez à jour le champ 'status' pour confirmer le compte
            $utilisateur->status = 1;
            $utilisateur->save();

            return redirect('/login')->with('status', 'Votre adresse e-mail a été confirmée avec succès. Vous pouvez maintenant vous connecter.');
        } else {
            // L'utilisateur avec le token n'existe pas, affichez un message d'erreur ou redirigez vers une page d'erreur
            return redirect('/')->with('error', 'Le lien de confirmation n\'est pas valide.');
        }
    }

    public function traitement_login(Request $request)
    {
        $request->validate([
            'userCredential' => 'required',
            'password' => 'required|min:6',
        ]);

        $userCredential = $request->input('userCredential');
        $userPassword = $request->input('password');

        $utilisateur = User::where(function ($query) use ($userCredential) {
            $query->where('username', $userCredential)
                ->orWhere('email', $userCredential);
        })->first();

        if ($utilisateur) {
            if ($utilisateur->status == 1) {
                if (Hash::check($userPassword, $utilisateur->password)) {
                    $request->session()->put('utilisateur', $utilisateur);
                    if ($utilisateur->isadmin == 0) {
                        return redirect('/userProfil');
                    } else {
                        return redirect('admin');
                    }
                } else {
                    return back()->with('status', 'Désolé, vos identifiants sont incorrects.');
                }
            } else {
                return back()->with('status', 'Veuillez vérifier votre email pour confirmer votre compte.');
            }
        } else {
            return back()->with('status', 'Désolé, vous n\'avez pas de compte.');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->forget('utilisateur');
        return redirect('/login')->with('status', 'Vous venez de vous déconnecter.');
    }
    public function edit($id)
    {
        // Récupère le produit à modifier par son ID
        $users = User::find($id);
        return view('edit', compact('users'));
    }
    public function update(Request $request)
    {


        // Validation des champs du formulaire
        $request->validate([
            'username' => 'string',
            'email' => 'string',
        ]);
        $users = User::find($request->id);
        // Récupère le users à mettre à jour par son ID
        // Création d'une nouvelle instance de produit
        $users->username = $request->username;
        $users->email = $request->email;
        $users->update();
        session(['utilisateur' => $users]);
        return redirect('/userProfil')->with('status', 'votre profil a été bien modifié avec succès.');
    }
    public function showUserProfile()
    {
        $userId = session('utilisateur')->id;
        $user = User::find($userId);
        $commentaires = Commentaire::where('id_user', $userId)->get();
        return view('UserProfile', compact('user', 'commentaires', 'url_info'));
    }
}
