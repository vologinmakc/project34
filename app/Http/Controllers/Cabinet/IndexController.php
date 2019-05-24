<?php

namespace App\Http\Controllers\Cabinet;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $group = $user->group;
        $sort = 'created_at';

        if ($request->isMethod('post') and $request->sort != '')
        {
            $sort = $request->sort;
        }
        if ($sort == 'created_at')
        {
            $tasks = $user->tasks()->orderBy("$sort", 'desc')->get();
        } else
        {
            $tasks = $user->tasks()->orderBy("$sort", 'asc')->get();
        }


        # вывод шаблона по группе
        if ($group->name == 'Снабжение')
        {
            return view('cabinet.supplies.supplies', [
                'tasks' => $tasks,
                'group' => $group,
                'sort' => $sort
            ]);
        }


        //dd($group->name);
        return view('cabinet.index');
    }
}
