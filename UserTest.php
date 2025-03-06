<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * Verificar que un usuario se crea correctamente.
     *
     * @return void
     */
    public function test_user_creation()
    {
        // Creamos un usuario de prueba
        $user = User::factory()->create();

        // Verificamos que el usuario se ha creado correctamente
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    /**
     * Verificar que un usuario tiene un nombre completo.
     *
     * @return void
     */
    public function test_user_full_name()
    {
         // Creamos un usuario de prueba usando el factory
         $user = User::factory()->create([
            'name' => 'Monty Lemke',
        ]);

        // Verificamos que el nombre completo sea igual al nombre del usuario
        $this->assertEquals('Monty Lemke', $user->name);
    }
}
