<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('terms')->truncate();

        \DB::table('terms')->insert([
                                         [
                                             'id'    =>  '1',
                                             'name'  =>  'First',
                                         ],
                                         [
                                             'id'    =>  '2',
                                             'name'  =>  'Annual',
                                         ],
                                     ]);
    }
}
