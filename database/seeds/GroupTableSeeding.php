<?php

use Illuminate\Database\Seeder;

class GroupTableSeeding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = \App\Group::firstOrNew(['name' => 'Снабжение']);

        if (!$group->exists) {
            $group->fill([
                'name' => 'Снабжения',
            ]);
        }

        $group->save();
    }
}
