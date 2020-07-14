<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

$factory->define(Post::class, function (Faker $faker) {
    $user_id = App\User::all()->random()->id;
    $image = $faker->image();
    $imageFile = new File($image);
    return [
        'title'=>$faker->sentence(5),
        //'image'=>$faker->imageUrl(400,300),
        //'image'=>$faker->image('public/img',400,300,null,false),
        'image' => Storage::disk('public')->putFile('posts/'.$user_id, $imageFile), 
        'content'=>$faker->paragraph(3),
    ];
});