<?php

use Illuminate\Database\Seeder;
use App\Servicios;

class serviciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicio = Servicios::create(['nombre'=>'Técnico']);
        $servicio = Servicios::create(['nombre'=>'Ofimatico']);
        $servicio = Servicios::create(['nombre'=>'Apoyo']);        
    }
}
