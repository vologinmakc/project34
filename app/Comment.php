<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'task_id',
        'comment'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
