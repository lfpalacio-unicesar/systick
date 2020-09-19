<?php

use Illuminate\Database\Seeder;
use App\Suite;

class suiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $suite = Suite::create(['nombre'=>'N.A']);
        $suite = Suite::create(['nombre'=>'Office 365']);
        $suite = Suite::create(['nombre'=>'Office 2013 Plus']);
        $suite = Suite::create(['nombre'=>'Office 2016 Enterprise']); 
    }
}
