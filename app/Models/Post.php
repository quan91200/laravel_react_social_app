<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'post';
    protected $fillable = [
        'status',
        'content',
        'image_url',
        'created_by',
        'updated_by',
        'react',
        'is_comment'
    ];
    protected $casts = [
        'is_comment' => 'boolean',
    ];
    const STATUS_PUBLIC = 'public';
    const STATUS_PRIVATE = 'private';
    const STATUS_FRIEND = 'friend';
    public static function getStatus(): array
    {
        return [
            self::STATUS_PUBLIC => 'public',
            self::STATUS_PRIVATE => 'private',
            self::STATUS_FRIEND => 'friend',
        ];
    }
    // Quan hệ: 1 Bài đăng thuộc về một người dùng
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    // Quan hệ: Một bài đăng có nhiều bình luận
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($post) {
            $post->comments()->delete();
        });
        static::restoring(function ($post) {
            $post->comments()->restore();
        });
    }
    // Lọc bài viết theo bài đăng bật comment
    public function scopeWithComment($query)
    {
        return $query->where('is_comment', true);
    }
    // Lọc bài viết theo react
    public function scopeReact($query, $reaction)
    {
        return $query->where('react', $reaction);
    }
    // Lọc bài viết theo quy tắc hiển thị
    public function scopeStatus($query, $viewerId)
    {
        return $query->where(function ($query) use ($viewerId) {
            // Public
            $query->where('status', 'public')
                // Friend
                ->orWhere(function ($query) use ($viewerId){
                    $query->where('status', 'friend')
                        ->whereExists(function ($subQuery) use ($viewerId){
                            $subQuery->select(DB::raw(1))
                                ->from('follow')
                                ->whereColumn('follow.follower_id', 'post.created_by')
                                ->where('follow.followed_id', $viewerId)
                                ->where('follow.is_friend', true);
                            });
                })
                // Private
                ->orWhere(function ($query) use ($viewerId) {
                    $query->where('status', 'private')
                        ->where('created_by', $viewerId);
                });
        });
    }
}
