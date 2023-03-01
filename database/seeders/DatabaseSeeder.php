<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //So se nao dermos fresh
            //User::truncate();
            //Category::truncate();
            //Post::truncate();
            //php artisan migrate:fresh --seed

            //Especificar um especifico nome de utilizador
            $user = User::factory()->create([
               'name' => 'John Doe'
            ]);
            //dar override do user se quisermos especificar
            Post::factory(5)->create([
                'user_id' => $user->id
            ]);

            //Post::factory(5)->create();
    }
/*
        $user = User::factory()->create();

        $first = Category::create([
            'name' => 'First',
            'slug' => 'first'
        ]);
        $second = Category::create([
            'name' => 'Second',
            'slug' => 'second'
        ]);
        $third = Category::create([
            'name' => 'Third',
            'slug' => 'third'
        ]);

        $post = Post::create([
            'user_id' => $user->id,
            'category_id' => $first->id,
            'title' => 'My First Post',
            'slug' => 'my-first-post',
            'excerpt' => '<p>my first except</p>',
            'body' => 'my first body' 
        ]);
        $post2 = Post::create([
            'user_id' => $user->id,
            'category_id' => $second->id,
            'title' => 'My Second Post',
            'slug' => 'my-second-post',
            'excerpt' => '<p>my second except</p>',
            'body' => 'my second body' 
        ]);
        $post3 = Post::create([
            'user_id' => $user->id,
            'category_id' => $third->id,
            'title' => 'My Third Post',
            'slug' => 'my-third-post',
            'excerpt' => '<p>my third except</p>',
            'body' => 'my third body' 
        ]);*/
}
