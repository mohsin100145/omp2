<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sections')->truncate();

        \DB::table('sections')->insert([
                                         [
                                             'id'    =>  '1',
                                             'name'  =>  'A',
                                         ],
                                         [
                                             'id'    =>  '2',
                                             'name'  =>  'B',
                                         ],
                                     ]);
    }
}
