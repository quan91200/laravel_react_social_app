<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Follow;
use App\Models\User;
class FollowFactory extends Factory
{
    protected $model = Follow::class;
    public function definition(): array
    {
        // Đảm bảo follower_id và followed_id không giống nhau
        do {
            $follower = User::factory()->create();  // Tạo người theo dõi ngẫu nhiên
            $followed = User::factory()->create();  // Tạo người bị theo dõi ngẫu nhiên
        } while ($follower->id === $followed->id); // Kiểm tra nếu chúng giống nhau thì lặp lại

        return [
            'follower_id' => $follower->id,  // Người theo dõi
            'followed_id' => $followed->id,  // Người bị theo dõi
            'is_friend' => $this->faker->boolean,  // Trạng thái bạn bè ngẫu nhiên
        ];
    }
    // Tạo follow với trạng thái bạn bè
    public function asFriend()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_friend' => true,  // Đặt trạng thái là bạn bè
            ];
        });
    }
    // Tạo follow với trạng thái không phải bạn bè
    public function asNotFriend()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_friend' => false,  // Đặt trạng thái không phải bạn bè
            ];
        });
    }
}
