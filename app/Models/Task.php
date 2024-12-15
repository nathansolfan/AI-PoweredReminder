<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        // 'priority',
        'deadline',
        'category'
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];
}
