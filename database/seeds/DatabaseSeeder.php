<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(TermsTableSeeder::class);
        $this->call(YearsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
    }
}
