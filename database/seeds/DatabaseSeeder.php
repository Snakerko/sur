<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(QuestionTableSeeder::class);
        $this->call(AnswerTableSeeder::class);
        $this->call(OrgTableSeeder::class);
        $this->call(RepTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
