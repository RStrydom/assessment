<?php

declare(strict_types=1);

namespace TaskFighter\Controllers;

// App
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Requests\PagerRequest;
use App\Http\Controllers\Controller;

// Framework
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;


class TaskController extends Controller
{
    /**
     * Display all tasks.
     *
     * @return JsonResource
     */
    public function all(): JsonResource
    {
        $tasks = Task::all();

        return TaskResource::collection($tasks);
    }

    /**
     * Display a paginated listing of tasks.
     *
     * @return JsonResource
     */
    public function index(PagerRequest $request): JsonResource
    {
        $pageSize = $request->input('per_page', 10);
        $tasks = Task::orderBy('due_in')->paginate($pageSize);

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Requests\TaskRequest  $request
     * @return JsonResource
     */
    public function store(TaskRequest $request): JsonResource
    {
        $input = $request->only([
            'name',
            'priority',
            'due_in'
        ]);
        $task = Task::create($input);

        return new TaskResource($task);
    }

    /**
     * Display the specified task.
     *
     * @param  \App\Task  $task
     * @return JsonResource
     */
    public function show(Task $task): JsonResource
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return JsonResource
     */
    public function update(Request $request, Task $task): JsonResource
    {
        $input = $request->only([
            'name',
            'priority',
            'due_in'
        ]);
        $task->update($input);

        return new TaskResource($task);
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
