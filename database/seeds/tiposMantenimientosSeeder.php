<?php

use Illuminate\Database\Seeder;
use App\tiposMantenimientos;

class tiposMantenimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = tiposMantenimientos::create(['nombre'=>'Preventivo']);
        $tipo = tiposMantenimientos::create(['nombre'=>'Correctivo']);
    }
}
