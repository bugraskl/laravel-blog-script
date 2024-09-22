<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = User::factory(10)->create();
        $categories = Category::factory(5)->create();

        $users->each(function($user) use ($categories) {
            Post::factory(5)->create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
            ]);
        });
    }
}
