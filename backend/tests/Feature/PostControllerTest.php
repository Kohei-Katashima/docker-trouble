<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testIndex()
    {
        $response = $this->get(route('posts.index'));

        $response->assertStatus(200)
            ->assertViewIs('posts.index');
    }

    public function testGuestCreate()
    {
        $response = $this->get(route('posts.create'));

        $response->assertRedirect(route('login'));
    }    

    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('posts.create'));

        $response->assertStatus(200)
            ->assertViewIs('posts.create');
    }
}
