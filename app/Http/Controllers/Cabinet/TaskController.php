<?php

namespace App\Http\Controllers\Cabinet;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function detail(Task $task)
    {
        if ($task) {
            $task = $task->with('comments', 'comments.users')->find($task->id);

            return view('cabinet.supplies.supplies-detail', [
                'task' => $task
            ]);
        }

    }
}
