<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    protected $table = 'follow';
    protected $fillable = [
        'follower_id',
        'followed_id',
        'is_friend',
    ];
    // Người dùng follow người khác
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
    // Người khác follow người dùng
    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
    // Xác nhận quan hệ
    public function isFriend()
    {
        return $this->is_friend;
    }
    // Lọc người dùng theo trạng thái bạn bè
    public function scopeFriend($query)
    {
        return $query->where('is_friend', true);
    }
    public function scopeNotFriend($query)
    {
        return $query->where('is_friend', false);
    }
    // Kiểm tra nếu người dùng đã follow một người khác
    public static function isFollowing($followerId, $followedId)
    {
        return self::where('follower_id', $followerId)
                    ->where('followed_id', $followedId)
                    ->exists();
    }
    // Tạo một kết nối follow mới hoặc cập nhật trạng thái bạn bè
    public static function toggleFriendship($followerId, $followedId, $isFriend = false)
    {
        $follow = self::firstOrCreate(
            ['follower_id' => $followerId, 'followed_id' => $followedId],
            ['is_friend' => $isFriend]
        );
        // Cập nhật trạng thái bạn bè
        if ($follow->exists) {
            $follow->update(['is_friend' => $isFriend]);
        }
    }
}

