<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $table = 'universities';

    protected $fillable = [
        'name',
        'description',
        'avatar',
        'location',
    ];
    
    // Quan hệ một-đến-nhiều với bảng Universities
    public function users()
    {
        return $this->hasMany(User::class, 'university_id', 'id');
    }
}
