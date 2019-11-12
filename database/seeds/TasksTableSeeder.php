<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->insert([
            ['name' => 'Get Older', 'priority' => 50, 'dueIn' => 365],
            ['name' => 'Spin the World', 'priority' => 1000, 'dueIn' => '30'],
            ['name' => 'Complete Assessment', 'priority' => 50, 'dueIn' => 15],
        ]);
    }
}
