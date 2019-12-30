<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['topic' => 'finance'],
            ['topic' => 'sport'],
            ['topic' => 'cryptocurrency'],
            ['topic' => 'cooking'],
            ['topic' => 'film'],

        ];
        foreach ($data as $d) {
            DB::table('topics')->insert([
                'topic' => $d['topic'],
            ]);
        }
    }
}
