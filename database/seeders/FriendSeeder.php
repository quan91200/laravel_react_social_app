<?php

namespace Database\Seeders;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Database\Seeder;

class FriendSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        if ($users->count() > 1) {
            foreach ($users as $user) {
                // Lấy ngẫu nhiên một danh sách bạn bè từ người dùng khác
                $friends = $users->where('id', '!=', $user->id)->random(rand(1, 3));

                foreach ($friends as $friend) {
                    // Tạo kết nối từ user đến friend
                    Friend::firstOrCreate([
                        'user_id' => $user->id,
                        'friend_id' => $friend->id,
                    ], [
                        'status' => 'accepted', // Đánh dấu họ đã là bạn bè
                    ]);
                    // Tạo kết nối ngược lại (tùy chọn nếu cần, vì quan hệ bạn bè thường là hai chiều)
                    Friend::firstOrCreate([
                        'user_id' => $friend->id,
                        'friend_id' => $user->id,
                    ], [
                        'status' => 'accepted',
                    ]);
                }
            }
        }
    }
}