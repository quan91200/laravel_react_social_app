<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
class PostFactory extends Factory
{
    public function definition(): array
    {
        // Lấy tất cả các file trong thư mục storage/app/images
        $images = Storage::files('images');
        return [
            'created_by' => User::factory(),
            'updated_by' => User::factory(),
            'status' => $this->faker->randomElement(['public', 'private', 'friend']),
            'content' => $this->faker->text(200),
            'image_url' => $this->faker->randomElement($images), 
        ];
    }
}
