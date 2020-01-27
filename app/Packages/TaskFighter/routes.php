<?php

use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for TaskFighter.
|
| Assumed:
| - prefix = api/tasks
| - namespace = TaskFighter\Controllers
| - middleware = api
|
| @see RouteServiceProvider
|
*/


Route::get('list/tick', function (Response $response) {
    $tasks = DB::table('tasks')->select('*')->get();
    foreach ($tasks as $task) {
        $taskFighter = new \App\Models\Task($task->name, $task->priority, $task->due_in);
        $taskFighter->tick();
        DB::update("update tasks set priority = '{$taskFighter->priority}', due_in = '{$taskFighter->due_in}' where id = '{$task->id}'");
    }

    return $response->setStatusCode(204);
});

Route::get('/all', 'TaskController@all');

Route::resource('/', 'TaskController');
