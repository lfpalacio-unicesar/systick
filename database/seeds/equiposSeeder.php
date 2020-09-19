<?php

use Illuminate\Database\Seeder;
use App\Equipos;

class equiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $equipo = Equipos::create([
            'tipo_id'=>1,
            'critico'=>0,            
            'oficina_id'=>1,
            'marca_id'=>1,
            'modelo'=>'Modelo # 1',
            'sticker'=>'002130',
            'sticker_monitor'=>'002131',
            'sticker_teclado'=>'002132',
            'sticker_mouse'=>'002133',
            'procesador'=>'i7-7700HQ',
            'ram'=>'6 GB',
            'almacenamiento'=>'320 GB',
            'sistema_id'=>1,
            'estadoSistema'=>0,
            'suite_id'=>1,
            'estadoSuite'=>1,
            'antivirus_id'=>1,
            'estadoAntivirus'=>0,
            'fcompra'=>'2019-04-10',
            'nombre'=>'PC 1',
            'ip'=>'127.0.0.1',
            'mac'=>'60-6D-C7-F6-8F-1B',            
            'asignado'=>'Miguel Fuentes',
            'usuario_id'=>1,                  
        ]);

        $equipo = Equipos::create([
            'tipo_id'=>1,
            'critico'=>1,            
            'oficina_id'=>3,
            'marca_id'=>2,
            'modelo'=>'Modelo # 2',
            'sticker'=>'002146',
            'sticker_monitor'=>'002147',
            'sticker_teclado'=>'002148',
            'sticker_mouse'=>'002149',            
            'procesador'=>'AMD Ryzen',
            'ram'=>'8 GB',
            'almacenamiento'=>'500 GB',
            'sistema_id'=>2,
            'estadoSistema'=>1,
            'suite_id'=>2,
            'estadoSuite'=>1,
            'antivirus_id'=>3,
            'estadoAntivirus'=>1,
            'fcompra'=>'2019-04-2',
            'nombre'=>'PC 2',
            'ip'=>'127.0.0.1',
            'mac'=>'60-6D-C7-F6-8F-1H',            
            'asignado'=>'Andres Jimenéz',
            'usuario_id'=>2,                        
        ]);
            
    }
}
