<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\FollowSeeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            FollowSeeder::class
        ]);
    }
}
