<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Usuario::factory()->count(3)->create();
        $usuario = new Usuario();
        $usuario->login = 'admin';
        $usuario->password = bcrypt('admin');
        $usuario->save();

        $usuario = new Usuario();
        $usuario->login = 'user';
        $usuario->password = bcrypt('user');
        $usuario->save();
    }
}
