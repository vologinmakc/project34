<?php

use Illuminate\Database\Seeder;

class CommentTableSeeding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = \App\Comment::firstOrNew(['id' => 1]);

        if (!$comment->exists) {
            $comment->fill([
                'task_id' => 1,
                'comment' => 'блин они большие все сильно!'
            ]);
        }

        $comment->save();
    }
}
