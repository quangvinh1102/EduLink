<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chat';
    public $timestamp = true;

    protected $fillable = [
        'id_chat',
        'user_id',
        'created_at',
        'updated_at'
    ];

    // Quan hệ nhiều-đến-một với bảng User
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
