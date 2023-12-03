<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
        'location',
        'gender',
        'avatar',
        'role',
        'university_id',
        "email_verified_at",
        "remember_token",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public $timestamp = true;

    // Quan hệ nhiều-đến-một với bảng Universities
    public function universities()
    {
        return $this->belongsTo(University::class, 'university_id', 'id');
    }

    // Quan hệ một-đến-nhiều với bảng Articles
    public function articles()
    {
        return $this->hasMany(Articles::class, 'user_id', 'id');
    }

    // Quan hệ một-đến-nhiều với bảng chat messages
    public function chat()
    {
        return $this->hasMany(Chat::class, 'user_id', 'id');
    }

    // Quan hệ một-đến-nhiều với bảng chat comments
    public function comments()
    {
        return $this->hasMany(Comments::class, 'user_id', 'id');
    }
}
