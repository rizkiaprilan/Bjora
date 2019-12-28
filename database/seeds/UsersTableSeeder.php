<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=> 'Mufid Rahman','email'=>'mufid@gmail.com','password'=>'12345678','birthday'=>'1999-03-15','gender'=>'male','address'=>'Padang','photo'=>'myhome.jpg','role'=>'admin'],
            ['name'=> 'Cristiano Ronaldo','email'=>'ronaldo@gmail.com','password'=>'12341234','birthday'=>'1999-04-20','gender'=>'male','address'=>'Portugal','photo'=>'ronaldo.jpeg','role'=>'member'],
            ['name'=> 'Kendall Jenner','email'=>'kendall@gmail.com','password'=>'12341234','birthday'=>'1999-10-12','gender'=>'female','address'=>'Los Angeles','photo'=>'kendall-jenner.jpg','role'=>'member'],

        ];
        foreach ($data as $d){
            DB::table('users')->insert([
                'name' => $d['name'],
                'email' => $d['email'],
                'password' => Hash::make($d['password']),
                'birthday' => $d['birthday'],
                'gender' => $d['gender'],
                'role' => $d['role'],
                'address' => $d['address'],
                'photo' => $d['photo'],
            ]);
        }
    }
}
