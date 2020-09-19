<?php

use Illuminate\Database\Seeder;
use App\Softwares;

class softwaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $software = Softwares::create(['nombre'=>'Winrar']);
        $software = Softwares::create(['nombre'=>'Adobe Reader']);
        $software = Softwares::create(['nombre'=>'Chrome']);
        $software = Softwares::create(['nombre'=>'Firefox']);
        $software = Softwares::create(['nombre'=>'Filezilla']);
        $software = Softwares::create(['nombre'=>'7Zip']);
        $software = Softwares::create(['nombre'=>'Winzip']);
        $software = Softwares::create(['nombre'=>'Ccleaner']);
        $software = Softwares::create(['nombre'=>'Defraggler']);       
    }
}
