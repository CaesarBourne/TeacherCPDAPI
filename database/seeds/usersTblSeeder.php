<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;


class usersTblSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Alban Afmeti',
            'email' => 'albanafmeti@gmail.com',
            'password' => Hash::make('Soulmate123@')
        ];

        User::create($user);
    }
}
