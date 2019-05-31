<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Requests\StoreTaksRequest;
use App\SubTask;
use App\Task;
use App\TaskImage;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function detail(Task $task, Request $request)
    {
        if ($request->isMethod('post'))
        {
            dd($request->all());
        }

        if ($task)
        {
            $task = $task->with('sub_tasks', 'comments', 'comments.users')->find($task->id);
            $images = $task->task_images()->get();

            return view('cabinet.supplies.supplies-detail', [
                'task' => $task,
                'images' => $images
            ]);
        }

    }

    public function create()
    {
        if (Auth::user())
        {
            $users = User::all();

            return view('cabinet.supplies.supplies-create', [
                'users' => $users
            ]);
        }

    }

    public function store(StoreTaksRequest $request)
    {
        if (Auth::user())
        {
            # для начала созраним задачу
            $data = $request->all();
            $files = $request->file();

            if (!empty($data) and is_array($data))
            {
                $task = new Task();
                $task->fill($data);
                $task->create_user_id = Auth::user()->id;

                $task->save();
                # Проверим на наличии доп позиций и сохраним их
                foreach ($data as $key => $value)
                {
                    if (strpos($key, 'sub_task') === 0)
                    {
                        $sub_task = new SubTask([
                            'title' => $value
                        ]);
                        if ($task->id)
                        {
                            $task->sub_tasks()->save($sub_task);
                        }
                    }
                }

            }

            # сохраним файлы изображений
            if (isset($files['task_images']))
            {
                $i = 0;
                foreach ($files['task_images'] as $file)
                {
                    if ($task->id)
                    {
                        $image = $file->storeAs('/files/task_images', 'img-' . time() . $i, 'public');

                        $task_image = new TaskImage();
                        $task_image->url = $image;

                        $task->task_images()->save($task_image);
                    }
                    $i++;
                }
            }
        }
        return redirect()->route('cabinet.index');
    }

    public function update(Request $request)
    {
        if (Auth::user())
        {
            $this->validate($request, [
                'task_id' => 'required|numeric',
                'status' => 'required|string'
            ]);

            $data = $request->all();

            $task = Task::find($data['task_id'])->first();
            if ($task)
            {
                $task->fill($data);
                $task->save();

                return redirect()->back();
            }
        }
    }
}
