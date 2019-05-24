<?php

namespace App\Http\Controllers\Cabinet;

use App\SubTask;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubTaskController extends Controller
{
    public function update(Request $request)
    {
        if (Auth::user())
        {
            $data = $request->all();
            foreach ($data as $key => $value)
            {
                if (strpos($key, 'id') === 0)
                {
                    $checkbox = explode('-', $key);
                    $sub_task = SubTask::find($checkbox[1]);// Здесь лежит id
                    $sub_task->complete = ($value == 'true') ? 1 : 0;
                    $sub_task->save();
                }
                if (strpos($key, 'notice') === 0)
                {
                    $notice = explode('-', $key);
                    $notice[] = $value;
                    $sub_task = SubTask::find($notice[1]);
                    $sub_task->notice = $notice[2];
                    $sub_task->save();
                }
            }
            return redirect()->route('cabinet.index');
        }


    }

    public function add(Request $request, Task $task)
    {
        if (Auth::user())
        {
            $this->validate($request, [
                'title' => 'required|string',
                'notice' => 'string'
            ]);

            $fields = $request->all();

            $sub_task = new SubTask();
            $sub_task->fill($fields);

            $task->sub_tasks()->save($sub_task);

            return redirect()->back();
        }
    }
}
