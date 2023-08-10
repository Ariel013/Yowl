<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Route_Commentaire extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function Route_commentaires(): void
    {
        $response = $this->get('/commentaires');

        $response->assertStatus(302);
    }
}
