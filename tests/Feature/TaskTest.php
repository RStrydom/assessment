<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if one can view paginated tasks.
     *
     * @return void
     */
    public function testViewingTasks(): void
    {
        $this->seed();

        $response = $this->getJson('api/tasks');

        $response->assertOk()
            ->assertJsonStructure([
                "data" => [0 => [
                    'id',
                    'name',
                    'priority',
                    'due_in',
                    'created_at',
                    'updated_at'
                ]],
                "links" => [
                    "first",
                    "last",
                    "prev",
                    "next"
                ],
                "meta" => [
                    "current_page",
                    "from",
                    "last_page",
                    "path",
                    "per_page",
                    "to",
                    "total"
                ]
            ]);
    }

    /**
     * Test if one can view a paginated tasks with a custom page size.
     *
     * @return void
     */
    public function testViewingTasksPagesize(): void
    {
        $pageSize = 25;
        $response = $this->getJson('api/tasks?per_page=' . $pageSize);

        $response->assertOk()
            ->assertJsonPath("meta.per_page", (string) $pageSize);
    }

    /**
     * Test if one can view all tasks.
     *
     * @return void
     */
    public function testViewingAllTasks(): void
    {
        $this->seed();

        $response = $this->getJson('api/tasks/all');

        $response->assertOk()
            ->assertJsonStructure(["data" => [0 => [
                'id',
                'name',
                'priority',
                'due_in',
                'created_at',
                'updated_at'
            ]]]);
    }

    /**
     * Test if one can create a new task.
     *
     * @return void
     */
    public function testCreatingTask(): void
    {
        $data = [
            'name' => 'Test Task',
            'priority' => random_int(1, 100),
            'due_in' => random_int(1, 365),
        ];

        $response = $this->postJson('api/tasks', $data);

        $response->assertCreated()
            ->assertJsonFragment($data)
            ->assertJson(['data' => $data]);

        $this->assertDatabaseHas('tasks', $data);
    }

    /**
     * Test if one can retreive a specific task.
     *
     * @return void
     */
    public function testFetchingTask(): void
    {
        $this->seed();

        $response = $this->getJson('api/tasks/1');

        $response->assertOk()
            ->assertJson([
                "data" => [
                    'name' => 'Get Older',
                    'priority' => 50,
                    'due_in' => 365
                ]
            ]);
    }

    /**
     * Test if one can update a specific task.
     *
     * @return void
     */
    public function testUpdatingTask(): void
    {
        $this->seed();

        $data = [
            "id" => 1,
            "name" => "New Name"
        ];

        $oldTaskResponse = $this->getJson('api/tasks/' . $data['id']);
        $oldTask = $oldTaskResponse['data'];

        $response = $this->putJson('api/tasks/' . $data['id'], $data);

        $response->assertOk()
            ->assertJsonPath('data.name', $data['name']);

        $this->assertDatabaseHas('tasks', $data);
        $this->assertDatabaseMissing('tasks', $oldTask);
    }

    /**
     * Test if one can delete a specific task.
     *
     * @return void
     */
    public function testDeletingTask(): void
    {
        $this->seed();

        $data = [
            "id" => 1
        ];

        $response = $this->deleteJson('api/tasks/' . $data['id']);

        $response->assertNoContent();

        $this->assertDatabaseMissing('tasks', $data);
    }
}
