<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
      DB::table('users')->insert([
        'username'=>'Самый Главный',
        'email'=>'admin@ad.min',
        'password'=>Hash::make('admin'),
        'admin'=>1,
        'report_id'=>1,
        'organization_id'=>1
      ]);
    }
}