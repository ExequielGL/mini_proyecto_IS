<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     */
    public function testUserCreation()
    {
        $userData = [
            'email' => 'italo.gonzalez.com',
            'password' => 'pass',
        ];

        //Registro con campos invalidos
        $response = $this->post('/register', $userData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email',
            'password'
        ]);
    }

    public function testSuccessfulRegister()
    {
        $userData = [
            'name' => 'Italo Gonzalez',
            'email' => 'Italo.gonzalez@example.com',
            'password' => bcrypt('password123'),
        ];

        $response = $this->post('/register', $userData);

        $response->assertStatus(302);
        $response->assertRedirect('/products');
    }
}
