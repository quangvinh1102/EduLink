<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
    use HasFactory;

    protected $table = 'chat_messages';
    public $timestamp = true;

    protected $fillable = [
        'user_id',
        'content',
    ];

    // Quan hệ nhiều-đến-một với bảng User
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
