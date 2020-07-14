<?php

use Illuminate\Database\Seeder;

class UserCollectionSeeder extends Seeder
{
    public function run()
    {
        $users = factory(App\User::class, 10)
            ->create()
            ->each( function ($user) {
                $user->posts()->createMany(
                    factory(App\Post::class, 5)->make()->toArray()
                );
            });
    }
}
