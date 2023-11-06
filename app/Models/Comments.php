<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';
    public $timestamp = true;

    protected $fillable = [
        'user_id',
        'article_id',
        'content',
        'parent_id'
    ];

    // Quan hệ nhiều-đến-một với bảng Users
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Quan hệ nhiều-đến-một với bảng Articles
    public function articles()
    {
        return $this->belongsTo(Articles::class, 'article_id', 'id');
    }

}
