<?php

use Illuminate\Database\Seeder;
use App\Oficinas;

class oficinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oficina = Oficinas::create(['nombre'=>'COORD_SISTEMAS','tipo'=>1]);
        $oficina = Oficinas::create(['nombre'=>'COORD_RECURSOS HUMANOS','tipo'=>1]);
        $oficina = Oficinas::create(['nombre'=>'COORD_VERTIMIENTOS','tipo'=>1]);
        $oficina = Oficinas::create(['nombre'=>'COORD_RECURSOS HIDRICOS','tipo'=>1]);
        $oficina = Oficinas::create(['nombre'=>'COORD_JURIDICA AMBIENTAL','tipo'=>1]);
    }
}
