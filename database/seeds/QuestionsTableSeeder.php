<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['user_id'=>2,'name'=> 'Cristiano Ronaldo','topic'=>'finance','question'=>'gimana cara pinjem duit di bank?','status'=>'open'],
            ['user_id'=>3,'name'=> 'Kendall Jenner','topic'=>'finance','question'=>'gimana cara transfer di bank?','status'=>'open'],
            ['user_id'=>2,'name'=> 'Cristiano Ronaldo','topic'=>'finance','question'=>'gimana cara bikin rekening di bank?','status'=>'open'],

        ];
        foreach ($data as $d){
            DB::table('questions')->insert([
                'name' => $d['name'],
                'user_id' => $d['user_id'],
                'topic' => $d['topic'],
                'status' => $d['status'],
                'question' => $d['question'],
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),

            ]);
        }
    }
}
