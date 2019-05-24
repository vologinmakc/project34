<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    protected $fillable = [
        'title',
        'notice',
        'active',
        'task_id'
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
