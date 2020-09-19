<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(marcasSeeder::class);
        $this->call(sistemasSeeder::class);
        $this->call(tiposEquiposSeeder::class);
        $this->call(serviciosSeeder::class);
        $this->call(antivirusSeeder::class);  
        $this->call(oficinasSeeder::class);
        $this->call(estadosTicketsSeeder::class);
        $this->call(usuariosSeeder::class);
        $this->call(softwaresSeeder::class);
        $this->call(suiteSeeder::class);
        //$this->call(equiposSeeder::class);
        //$this->call(ticketsSeeder::class);
        $this->call(tiposMantenimientosSeeder::class);
    }
}
