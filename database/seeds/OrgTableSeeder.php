<?php

use Illuminate\Database\Seeder;
use App\Organization;

class OrgTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'org_name'=>'adminka'
          ]);
    }
}
