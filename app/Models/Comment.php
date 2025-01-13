<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'content',
        'image_url',
    ];
    // Bình luận thuộc về một bài đăng
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    // Bình luận thuộc về 1 người dùng
    public function comment()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
    // Bình luận có thể có nhiều bình luận con
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    // Bình luận có thể thuộc về 1 bình luận cha
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    /**
        * Lấy các bản ghi children ngay lập tức của model
        * và tải trước mối quan hệ 'user' cho từng children.
     */
    public function immediateChildren()
    {
        return $this->children()->with('user');
    }
}
