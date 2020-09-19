<?php

use Illuminate\Database\Seeder;
use App\EstadosTickets;

class estadosTicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado = EstadosTickets::create(['nombre' => 'Creado']);
        $estado = EstadosTickets::create(['nombre' => 'Asignado']);
        $estado = EstadosTickets::create(['nombre' => 'Con respuesta']);
        $estado = EstadosTickets::create(['nombre' => 'Reabierto']);
        $estado = EstadosTickets::create(['nombre' => 'Cerrado']);
    }
}
