<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            'name' => 'IoT',
        ]);

        DB::table('topics')->insert([
            'name' => 'Mashup',
        ]);

        DB::table('topics')->insert([
            'name' => 'LinkedOpenData',
        ]);

        DB::table('topics')->insert([
            'name' => 'Paradigmi avanzati d"interazione',
        ]);

    }
}