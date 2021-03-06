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
        $faker = app(Faker\Generator::class);

        $avatars = [
            'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];

        $users_collection = factory(\App\User::class)->times(10)->make()->each(function ($user, $index) use ($faker, $avatars){
            $user->avatar = $faker->randomElement($avatars);
        });

        $users_array = $users_collection->makeVisible('password', 'remember_token')->toArray();

        \App\User::insert($users_array);

        $first_user = \App\User::find(1);
        $first_user->name = 'Summer';
        $first_user->email = 'summer@example.com';
        $first_user->save();
    }
}
