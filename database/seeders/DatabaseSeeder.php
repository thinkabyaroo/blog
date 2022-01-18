<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(100)->create();
         Category::factory(5)->create();
        Post::factory(200)->create();
        Tag::factory(20)->create();

        Post::all()->each(function ($post){
            $post->tags()->attach(Tag::inRandomOrder()->limit(rand(1,4))->get()->pluck('id'));
        });

        User::create([
            'name'=>'thin kabyar',
            'email'=>'admin@gmail.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('12121212'),
            'remember_token' => Str::random(10),
            'role'=>'0',
        ]);
    }
}
