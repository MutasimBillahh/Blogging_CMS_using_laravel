<?php

use App\Profile;
use App\User;
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
        $user = App\User::create([

            'name'=>'Tamim',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('123456'),
            'admin'=> 1

        ]);


        App\Profile::create([

            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/1.png',
            'about' => 'loremmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm',
            'facebook' =>'facebook.com',
            'youtube' =>'youtube.com'

        ]);
    }
}
