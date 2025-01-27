<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;
    protected $table = 'friends';
    protected $fillable = [
        'user_id',
        'friend_id',
        'status',
    ];
    // Quan hệ với User (Người gửi lời kết bạn)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Quan hệ với User (Người nhận lời kết bạn)
    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($friend) {
            if ($friend->user_id > $friend->friend_id) {
                [$friend->user_id, $friend->friend_id] = [$friend->friend_id, $friend->user_id];
            }
        });
    }
    public static function getFriendship($userId, $friendId)
    {
        return self::where(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $userId)
                ->where('friend_id', $friendId);
        })->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $friendId)
                ->where('friend_id', $userId);
        })->first();
    }
    // Scope để kiểm tra mối quan hệ bạn bè của người dùng hiện tại
    public function scopeIsFriendWith($query, $userId, $friendId)
    {
        return $query->where(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $userId)
                  ->where('friend_id', $friendId);
        })
        ->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $friendId)
                  ->where('friend_id', $userId);
        });
    }
    // Scope kiểm tra nếu mối quan hệ bạn bè đang chờ xác nhận (pending)
    public function scopeIsPending($query, $userId, $friendId)
    {
        return $query->where(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $userId)
                  ->where('friend_id', $friendId)
                  ->where('status', 'pending');
        })
        ->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $friendId)
                  ->where('friend_id', $userId)
                  ->where('status', 'pending');
        });
    }
    // Scope kiểm tra nếu mối quan hệ bạn bè đã được chấp nhận
    public function scopeIsAccepted($query, $userId, $friendId)
    {
        return $query->where(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $userId)
                  ->where('friend_id', $friendId)
                  ->where('status', 'accepted');
        })
        ->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $friendId)
                  ->where('friend_id', $userId)
                  ->where('status', 'accepted');
        });
    }
    // Scope kiểm tra nếu mối quan hệ bạn bè đã bị chặn
    public function scopeIsBlocked($query, $userId, $friendId)
    {
        return $query->where(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $userId)
                  ->where('friend_id', $friendId)
                  ->where('status', 'blocked');
        })
        ->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $friendId)
                  ->where('friend_id', $userId)
                  ->where('status', 'blocked');
        });
    }
}