<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use App\Http\Requests\FriendRequest;
use App\Http\Resources\FriendResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    // Danh sách người dùng
    public function index()
    {
        $currentUser = Auth::user();
        // Lấy danh sách đã kết bạn
        $friends = User::friendsList($currentUser->id)->get();
        // Lấy danh sách chưa kết bạn
        $notFriends = User::notFriends($currentUser->id)->get();
        return inertia('Friend/Index', [
            'friends' => UserResource::collection($friends),
            'not_friends' => UserResource::collection($notFriends),
        ]);
    }
    // Gửi lời mời kết bạn
    public function store(FriendRequest $request)
    {
        $user = Auth::user();
        $friendId = $request->friend_id;

        if ($user->id == $friendId) {
            return response()->json(['message' => 'Bạn không thể kết bạn với chính mình.'], 400);
        }
        $friendship = Friend::getFriendship($user->id, $friendId);
        if ($friendship) {
            return response()->json([
                'message' => 'Mối quan hệ đã tồn tại.',
                'status' => $friendship->status,
            ], 400);
        }
        $friend = Friend::create([
            'user_id' => $user->id,
            'friend_id' => $friendId,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lời mời kết bạn đã được gửi.',
            'data' => new FriendResource($friend),
        ]);
    }
    // Chấp nhận hoặc từ chối lời mời kết bạn
    public function update($id, FriendRequest $request)
    {
        $user = Auth::user();
        $friendship = Friend::findOrFail($id);
        if ($friendship->status !== 'pending') {
            return response()->json(['message' => 'Không thể cập nhật mối quan hệ này.'], 400);
        }
        if ($friendship->friend_id !== $user->id) {
            return response()->json(['message' => 'Bạn không có quyền thao tác.'], 403);
        }
        $status = $request->status;
        if ($status === 'accepted') {
            $friendship->update(['status' => 'accepted']);
            return response()->json(['success' => true, 'message' => 'Đã chấp nhận lời mời kết bạn.']);
        } elseif ($status === 'rejected') {
            $friendship->delete();
            return response()->json(['success' => true, 'message' => 'Đã từ chối lời mời kết bạn.']);
        }
        return response()->json(['success' => false, 'message' => 'Trạng thái không hợp lệ.'], 400);
    }
    // Hủy kết bạn
    public function destroy($id)
    {
        $user = Auth::user();
        $friendship = Friend::findOrFail($id);
        if (
            $friendship->user_id !== $user->id &&
            $friendship->friend_id !== $user->id
        ) {
            return response()->json(['message' => 'Bạn không có quyền thao tác.'], 403);
        }
        $friendship->delete();
        return response()->json(['message' => 'Đã hủy kết bạn thành công.'], 200);
    }
    // Chặn người bạn
    public function block($id)
    {
        $user = Auth::user();
        $friendship = Friend::findOrFail($id);
        if (
            $friendship->user_id !== $user->id &&
            $friendship->friend_id !== $user->id
        ) {
            return response()->json(['message' => 'Bạn không có quyền thao tác.'], 403);
        }
        $friendship->update(['status' => 'blocked']);
        return response()->json(['message' => 'Đã chặn người bạn này.'], 200);
    }
}
