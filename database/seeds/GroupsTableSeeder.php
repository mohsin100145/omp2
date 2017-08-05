<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('groups')->truncate();

        \DB::table('groups')->insert([
                                         [
                                             'id'    =>  '1',
                                             'name'  =>  'Science',
                                         ],
                                         [
                                             'id'    =>  '2',
                                             'name'  =>  'Humanities',
                                         ],
                                         [
                                             'id'    =>  '3',
                                             'name'  =>  'Business Studies',
                                         ],
                                     ]);
    }
}
