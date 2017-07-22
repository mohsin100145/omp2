<?php

use Illuminate\Database\Seeder;

class YearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('years')->truncate();

        \DB::table('years')->insert([
                                         [
                                             'id'    =>  '1',
                                             'year'  =>  '2017',
                                         ],
                                         [
                                             'id'    =>  '2',
                                             'year'  =>  '2018',
                                         ],
                                         [
                                             'id'    =>  '3',
                                             'year'  =>  '2019',
                                         ],
                                         [
                                             'id'    =>  '4',
                                             'year'  =>  '2020',
                                         ],
                                     ]);
    }
}
