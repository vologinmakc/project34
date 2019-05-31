<?php

namespace App\Http\Controllers\Cabinet;

use App\Task;
use App\TaskImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function delete(Request $request)
    {
        if (Auth::user())
        {
            $data = $request->all();
            if (!empty($data) and is_array($data))
            {
                foreach ($data as $key => $value)
                {
                    if (strpos($key, 'id') === 0)
                    {
                        $task_image = TaskImage::find($value);
                        $file_url = $task_image->url;

                        # Если файл существует удаляем его
                        if (Storage::disk('public')->exists($file_url))
                        {
                            Storage::disk('public')->delete($file_url);

                            $task_image->delete();
                        }

                    }
                }
            }
        }
    }

    public function add(Task $task, Request $request)
    {
        if (Auth::user())
        {
            $files = $request->file();

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
            return redirect()->back();
        }
    }
}
