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
        'attachment',
        'parent_id',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function subtasks()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    public function parentTask()
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }
}
