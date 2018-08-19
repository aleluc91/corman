<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Giuseppe',
            'last_name' => 'Desolda',
            'email' => 'test@email.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
            'date_of_birth' => '2000/01/01',
            'country' => 'Italy',
            'gender' => 'male',
            'affiliation' => 'Università degli studi di Bari',
            'lines_of_research' => 'ium,test,test',
            'dblp_id' => '412740'
        ]);

        DB::table('users')->insert([
            'name' => 'Maria Francesca',
            'last_name' => 'Costabile',
            'email' => 'test2@email.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
            'date_of_birth' => '2000/01/01',
            'country' => 'Italy',
            'gender' => 'female',
            'affiliation' => 'Università degli studi di Bari',
            'lines_of_research' => 'ium,test,test',
            'dblp_id' => '364028'
        ]);

    }
}
