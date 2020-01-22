<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
|
| Assumed:
|  - prefix     = api
|  - namespace  = App\Http\Controllers
|  - middleware = api
|
| @see RouteServiceProvider
|
*/


Route::get('list/tick', function (Response $response) {
    $tasks = DB::table('tasks')->select('*')->get();
    foreach ($tasks as $task) {
        $taskFighter = new \App\Task($task->name, $task->priority, $task->dueIn);
        $taskFighter->tick();
        DB::update("update tasks set priority = '{$taskFighter->priority}', dueIn = '{$taskFighter->dueIn}' where id = '{$task->id}'");
    }

    return $response->setStatusCode(204);
});

Route::get('tasks/all', 'API\TaskController@all');

Route::resource('tasks', 'API\TaskController');
