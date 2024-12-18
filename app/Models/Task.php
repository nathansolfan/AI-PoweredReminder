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
        'category',
        'attachment'
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];
}
