<?php

use Illuminate\Database\Seeder;
use App\Sistemas;

class sistemasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sistemas = Sistemas::create(['nombre'=>'N.A']);
        $sistemas = Sistemas::create(['nombre'=>'Windows XP Professional']);
        $sistemas = Sistemas::create(['nombre'=>'Windows XP Home Edition']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 7 Home Premium x86']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 7 Home Premium x64']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 7 Professional x86']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 7 Professional x64']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 7 Ultimate x86']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 7 Ultimate x64']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 7 Enterprise x86']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 7 Enterprise x64']);        
        $sistemas = Sistemas::create(['nombre'=>'Windows 8']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 10 Pro x86']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 10 Pro x64']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 10 Enterprise x86']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 10 Enterprise x64']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 10 Education x86']);
        $sistemas = Sistemas::create(['nombre'=>'Windows 10 Education x64']);
    }
}
