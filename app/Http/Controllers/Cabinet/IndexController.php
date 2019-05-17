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

    public function index()
    {
        $user = Auth::user();
        $group = $user->group;
        $tasks = $user->tasks()->orderBy('priority', 'asc')->get();


        # вывод шаблона по группе
        if ($group->name == 'Снабжение') {
            return view('cabinet.supplies.supplies', [
                'tasks' => $tasks,
                'group' => $group
            ]);
        }


        //dd($group->name);
        return view('cabinet.index');
    }
}
