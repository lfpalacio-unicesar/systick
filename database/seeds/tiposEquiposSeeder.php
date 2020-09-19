<?php

use Illuminate\Database\Seeder;
use App\tiposEquipos;

class tiposEquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = tiposEquipos::create(['nombre'=>'Computador']);
        $tipo = tiposEquipos::create(['nombre'=>'Portatil']);
        $tipo = tiposEquipos::create(['nombre'=>'Impresora']);
        $tipo = tiposEquipos::create(['nombre'=>'Scanner']);
        $tipo = tiposEquipos::create(['nombre'=>'Multifuncional']);
    }
}
