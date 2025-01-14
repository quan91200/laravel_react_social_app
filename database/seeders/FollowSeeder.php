<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy hai người dùng ngẫu nhiên
        $users = User::inRandomOrder()->limit(2)->get();
        // Kiểm tra xem có đủ hai người dùng không
        if ($users->count() === 2) {
            $user1 = $users[0];
            $user2 = $users[1];
            // Tạo kết nối follow giữa user1 và user2 và đánh dấu là bạn bè
            Follow::firstOrCreate([
                'follower_id' => $user1->id,
                'followed_id' => $user2->id,
            ], [
                'is_friend' => true
            ]);
            // Ngược lại, tạo kết nối follow từ user2 đến user1 và đánh dấu là bạn bè
            Follow::firstOrCreate([
                'follower_id' => $user2->id,
                'followed_id' => $user1->id,
            ], [
                'is_friend' => true
            ]);
        }
    }
}
