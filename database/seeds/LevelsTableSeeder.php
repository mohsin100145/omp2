<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('levels')->truncate();

        \DB::table('levels')->insert([
                                         [
                                             'id'    =>  '1',
                                             'name'  =>  'Six',
                                         ],
                                         [
                                             'id'    =>  '2',
                                             'name'  =>  'Seven',
                                         ],
                                         [
                                             'id'    =>  '3',
                                             'name'  =>  'Eight',
                                         ],
                                         [
                                             'id'    =>  '4',
                                             'name'  =>  'Nine',
                                         ],
                                         [
                                             'id'    =>  '5',
                                             'name'  =>  'Ten',
                                         ],
                                     ]);
    }
}
