<?php

use Illuminate\Database\Seeder;

class TaskTableSeeding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task = \App\Task::firstOrNew(['title' => 'Закупка подшибников']);

        if (!$task->exists) {
            $task->fill([
                'title' => 'Закупка подшибников',
                'task_body' => 'Нужно купить подшибники для Hitach 5шт.',
                'user_id' => 1,
                'group_id' => 1,
                'status' => 'WORK',
                'priority' => 'NORMAL',
                'create_user_id' => 1,
            ]);
        }

        $task->save();
    }
}
