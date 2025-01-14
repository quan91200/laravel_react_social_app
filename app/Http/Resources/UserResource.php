<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $isCurrentUser = Auth::id();
        return [
            'id' => $this->id,
            'auth' => $isCurrentUser,
            'name' => $this->name,
            'email' => $this->email,
            'profile_pic' => $this->profile_pic ? Storage::url($this->profile_pic) : null,
            'hobbies' => $this->hobbies,
            'address' => $this->address,
            'phone_number' => $this->phoneNumber,
            'dob' => $this->dob,
            'job' => $this->job,
            'relationship' => $this->relationship,
            'language' => $this->language,
            'dark_mode' => $this->dark_mode,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'posts_count' => $this->posts->count(), // Số lượng bài viết của người dùng
            'comments_count' => $this->comments->count(), // Số lượng comment của người dùng
            'friend_count' => $this->following->count(), // Số lượng người đang theo dõi
        ];
    }
}
