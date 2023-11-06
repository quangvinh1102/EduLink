<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $table = 'articles';
    public $timestamp = true;

    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    // Quan hệ nhiều-đến-một với bảng Universities
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    // Quan hệ một-đến-nhiều với bảng chat comments
    public function comments()
    {
        return $this->hasMany(Comments::class, 'article_id', 'id');
    }
    
}
