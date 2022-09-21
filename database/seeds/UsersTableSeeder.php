<?php

use App\Models\User;
use App\User as AppUser;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $myUser = new User();
        $myUser->name = 'Benedetta';
        $myUser->email = 'wasbenedettawas@gmail.com';
        $myUser->password = Hash::make('wasbenedetta1');
        $myUser->save();

        for ($i=0; $i < 15; $i++) { 
            $user = new User();
            $user->name = $faker->userName();
            $user->email = $faker->unique()->email();
            $user->password = Hash::make($faker->password());
            $user->save();
        }
    }
}
