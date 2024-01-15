<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase; // Veritabanını sıfırlamak için

    /**
     * Test user login.
     */
    public function testUserLogin()
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $response = $this->post('/api/login', [
            'email' => 'test@gmail.com',
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => true,
        ]);
    }

    /**
     * Test user registration.
     */
    public function testUserRegistration()
    {
        $this->artisan('db:seed');
        $userData = [
            'username' => 's@121a22',
            'email' => 'asdasd@asd.com',
            'phone' => '05312856454',
            'password' => 'test',
        ];
        $response = $this->post('/api/register', $userData);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => true,
        ]);
    }

}
