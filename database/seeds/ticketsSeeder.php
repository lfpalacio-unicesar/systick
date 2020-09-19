<?php

use Illuminate\Database\Seeder;
use App\Tickets;

class ticketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticket = Tickets::create([
            'servicio_id'=>'1',            
            'user_id'=>'1',
            'estado_id'=>'1',
            'titular'=>'Juan Mendez',
            'asunto'=>'Fallo equipo',
            'descripcion'=>'El equipo con codigo 20147 presenta fallo funcionamiento',
            'equipo_id'=>'2',
        ]);

        $ticket = Tickets::create([
            'servicio_id'=>'2',            
            'user_id'=>'2',
            'estado_id'=>'1',
            'titular'=>'Miguel Sanchez',
            'asunto'=>'Fallo Internet',
            'descripcion'=>'El equipo con codigo 20148 presenta conectividad',
        ]);

        $ticket = Tickets::create([
            'servicio_id'=>'3',      
            'user_id'=>'1',
            'estado_id'=>'1',
            'titular'=>'Daniel Hernandez',
            'asunto'=>'Fallo alimentación',
            'descripcion'=>'El equipo con codigo 20149 presenta fallo eléctrico',
        ]);
    }
}
