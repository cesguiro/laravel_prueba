<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Usuario;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = Usuario::All();
        $usuarios->each(function($autor) {
            Post::factory()->count(3)->create(['autor_id' => $autor->id]);
        });
    }
}
