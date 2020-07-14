<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserCollectionSeeder::class);
        //$this->call(PostsCollectionSeeder::class);
    }
}
