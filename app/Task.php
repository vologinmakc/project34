<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    # protected $dateFormat = 'U';

    protected $fillable = [
        'title',
        'task_body',
        'user_id',
        'group_id',
        'file',
        'status',
        'create_user_id',
        'priority'
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function sub_tasks()
    {
        return $this->hasMany('App\SubTask');
    }

    public function task_images()
    {
        return $this->hasMany('App\TaskImage');
    }

    public function task_files()
    {
        return $this->hasMany('App\TaskFile');
    }
}
