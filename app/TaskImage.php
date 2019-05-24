<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskImage extends Model
{
    protected $fillable = [
        'title',
        'alt',
        'task_id'
    ];

    public function tasks()
    {
        return $this->belongsTo('App\Task');
    }
}