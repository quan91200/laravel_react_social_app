<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Follow;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_pic',
        'hobbies',
        'address',
        'phoneNumber',
        'dob',
        'job',
        'relationship',
        'language',
        'dark_mode'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class, 'created_by');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // Theo dõi người khác
    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }
    // Người khác theo dõi
    public function followers()
    {
        return $this->hasMany(Follow::class, 'followed_id');
    }
    public function setLanguage($value)
    {
        $this->attributes['language'] = in_array($value, ['en', 'vn']) ? $value : 'en';
    }
    public function setDarkmode($value)
    {
        $this->attributes['dark_mode'] = in_array($value, ['light', 'dark'])  ?$value : 'dark';
    }
}
