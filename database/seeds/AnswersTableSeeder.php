<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['user_id'=>2,'answer'=>'Pertama tama harus punya rekening dahulu','question_id'=>2],
            ['user_id'=>3,'answer'=>'kedua harus punya duit juga dong','question_id'=>2],

        ];
        foreach ($data as $d){
            DB::table('answers')->insert([
                'user_id' => $d['user_id'],
                'question_id' => $d['question_id'],
                'answer' => $d['answer'],
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),

            ]);
        }
    }
}
