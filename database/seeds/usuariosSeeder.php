<?php

use Illuminate\Database\Seeder;
use App\User;

class usuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  

        $usuario = User::create([
            'name'=>'Super Admin User',
            'username'=>'superadmin',
            'email'=>'superadmin@hotmail.com',
            'imagen'=>'user.png',
            'estado'=>1,
            'rol'=>2,
            'oficina_id'=>1,
            'password'=>bcrypt('1234')
            ]);
    }
}
