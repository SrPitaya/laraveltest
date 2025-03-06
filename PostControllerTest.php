<?php
namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase; // Utiliza la funcionalidad de base de datos para refrescar la base de datos entre pruebas

    /**
     * Prueba de la ruta 'posts.index' que muestra la lista de posts.
     */
    public function test_index()
    {
        // Realiza una solicitud GET a la ruta 'posts.index' (controlador PostController, método index)
        $response = $this->get(route('posts.index'));

        // Verifica que la respuesta sea exitosa (código de estado 200)
        $response->assertStatus(200);

        // Verifica que la vista mostrada sea 'posts.index' (la vista que lista los posts)
        $response->assertViewIs('posts.index');
    }

    /**
     * Prueba de la ruta 'posts.create' que muestra el formulario para crear un nuevo post.
     */
    public function test_create()
    {
        // Realiza una solicitud GET a la ruta 'posts.create' (controlador PostController, método create)
        $response = $this->get(route('posts.create'));

        // Verifica que la respuesta sea exitosa (código de estado 200)
        $response->assertStatus(200);

        // Verifica que la vista mostrada sea 'posts.create' (la vista que contiene el formulario para crear un post)
        $response->assertViewIs('posts.create');
    }
    
    /**
     * Prueba de la ruta 'posts.store' que almacena un nuevo post en la base de datos.
     */
    public function test_store()
    {
        // Define los datos para el nuevo post
        $postData = [
            'title' => 'Test Post',  // Título del post
            'body' => 'This is the body of the post.',  // Cuerpo del post
        ];

        // Realiza una solicitud POST a la ruta 'posts.store' (controlador PostController, método store)
        // Se envían los datos del nuevo post
        $response = $this->post(route('posts.store'), $postData);

        // Verifica que la respuesta sea una redirección a la ruta 'posts.index' (donde se listan los posts)
        $response->assertRedirect(route('posts.index'));

        // Verifica que el mensaje de éxito se haya agregado a la sesión
        $response->assertSessionHas('success', 'Post was created');

        // Verifica que los datos del nuevo post estén presentes en la base de datos
        $this->assertDatabaseHas('posts', $postData);
    }
}
