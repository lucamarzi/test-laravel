<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
 /*       $sql = "insert into users (name, email, password)";
        $sql .= "values(:name, :email, :password)";

        for($i=0;$i<30; $i++) {
           DB::statement($sql,[
               'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password')
            ]);
            DB::table('users')->insert([
                'name' => 'Luca'.$i,
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => \Carbon\Carbon::now()
            ]);
        }*/

        $users = factory(User::class, 30)->create();
    }
}
