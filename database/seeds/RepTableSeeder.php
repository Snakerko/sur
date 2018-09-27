<?php

use Illuminate\Database\Seeder;
use App\Report;

class RepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Report::create();
    }
}
