<?php

use Illuminate\Database\Seeder;
use App\Antivirus;

class antivirusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $antivirus = Antivirus::create(['nombre'=>'N.A']);
        $antivirus = Antivirus::create(['nombre'=>'MacAfe']);
        $antivirus = Antivirus::create(['nombre'=>'Avast']);
        $antivirus = Antivirus::create(['nombre'=>'AVG']);
        $antivirus = Antivirus::create(['nombre'=>'Norton']);
        $antivirus = Antivirus::create(['nombre'=>'Symantec']);
        $antivirus = Antivirus::create(['nombre'=>'Panda']);
        $antivirus = Antivirus::create(['nombre'=>'Eset']);
    }
}
