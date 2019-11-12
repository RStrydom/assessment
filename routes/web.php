<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/tasks', function () {
    $tasks = DB::table('tasks')->select('*')->get();
    return $tasks;
});

Route::post('/tasks', function(\Illuminate\Http\Request $request) {
    DB::insert("insert into tasks set name = '{$request->name}', priority = '{$request->priority}', dueIn = '{$request->dueIn}'");
    return 'created';
});

Route::delete('/tasks/{id}', function(\Illuminate\Http\Request $request) {
    DB::delete("delete from tasks where id = '{$request->id}'");
    return 'deleted';
});

Route::get('/list/tick', function() {
    $tasks = DB::table('tasks')->select('*')->get();
    foreach ($tasks as $task) {
        $taskFighter = new \App\TaskFighter($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();
        DB::update("update tasks set priority = '{$taskFighter->priority}', dueIn = '{$taskFighter->dueIn}' where id = '{$task->id}'");
    }
    return 'tick';
});
