<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
class FollowController extends Controller
{
    public function follow($followedId)
    {
        $followerId = Auth::id();  // Lấy ID của người dùng đang thực hiện hành động

        // Kiểm tra xem người dùng có đang cố gắng follow chính mình không
        if ($followerId == $followedId) {
            return response()->json(['error' => 'Bạn không thể theo dõi chính mình.'], 400);
        }

        // Kiểm tra nếu người dùng đã follow người khác hay chưa
        if (Follow::isFollowing($followerId, $followedId)) {
            return response()->json(['message' => 'Bạn đã theo dõi người này.'], 200);
        }

        // Tiến hành tạo quan hệ theo dõi mới
        Follow::create([
            'follower_id' => $followerId,
            'followed_id' => $followedId,
        ]);

        return response()->json(['message' => 'Đã theo dõi thành công!'], 200);
    }
}
