<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     */
    public function testSuccessLogin()
    {
        $user = User::create([
            'name' => 'usertest',
            'email' => 'usertest@correo.com',
            'password' => bcrypt('1234567k')
        ]);


        $response = $this->post('/login', [
            'email' => 'usertest@correo.com',
            'password' => '1234567k',
        ]);

        $response->assertStatus(302); // Verifica el código de estado de la respuesta (redirección)
        $response->assertRedirect('products'); // Verifica que se redirija a la página de products
        $this->assertAuthenticatedAs($user); // Verifica que el usuario esté autenticado
    }

    public function test_fail_input()
    {
        $userData = [
            'email' => '',
            'password' => '',
        ];

        $response = $this->post('/login', $userData);
        $response->assertStatus(302); // Verifica el código de estado de la respuesta (redirección)
        $response->assertSessionHasErrors([
            'email',
            'password'
        ]);
    }
}
