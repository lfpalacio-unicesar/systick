<?php

use Illuminate\Database\Seeder;
use App\Marcas;

class marcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcas = Marcas::create(['nombre'=>'Hewlett Packard']);
        $marcas = Marcas::create(['nombre'=>'Epson']);
        $marcas = Marcas::create(['nombre'=>'Lenovo']);
        $marcas = Marcas::create(['nombre'=>'Toshiba']);
        $marcas = Marcas::create(['nombre'=>'Dell']);
        $marcas = Marcas::create(['nombre'=>'Sony']);
        $marcas = Marcas::create(['nombre'=>'Genius']);
        $marcas = Marcas::create(['nombre'=>'Asus']);
        $marcas = Marcas::create(['nombre'=>'Acer']);
        $marcas = Marcas::create(['nombre'=>'TP-Link']);
        $marcas = Marcas::create(['nombre'=>'D-Link']);
        $marcas = Marcas::create(['nombre'=>'Cisco']);

    }
}
