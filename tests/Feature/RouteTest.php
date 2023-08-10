<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Commentaire;


class RouteTest extends TestCase
{
//    use RefreshDatabase;

    // Test de la route d'accueil
    public function testWelcomeRoute()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // Test de la route de profil utilisateur
    public function testUserProfilRoute()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/userProfil');
        $response->assertStatus(200);
    }

    // Test de la route de connexion
    public function testLoginRoute()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    // Test de la route de commentaires
    public function testCommentairesRoute()
    {
        $response = $this->get('/commentaires');
        $response->assertStatus(200);
    }

    // Test de la route de déconnexion
    public function testLogoutRoute()
    {
        $response = $this->get('/logout');
        $response->assertStatus(302);
    }

    // Test de la route de déconnexion
    public function testRegisterRoute()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }



    // Test de la route de suppression de commentaire
    public function testCommentairesDestroyRoute()
    {
        $user = User::factory()->create();
        $commentaire = Commentaire::factory()->create(['id_user' => $user->id]);
        $response = $this->actingAs($user)->delete('/commentaires/' . $commentaire->id);
        $response->assertStatus(302); 
        
    }

}