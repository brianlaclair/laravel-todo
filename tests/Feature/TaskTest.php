<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and log them in
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_it_displays_a_list_of_tasks(): void
    {
        Task::factory()->for($this->user)->count(3)->create();

        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('tasks');
        $this->assertCount(3, $response->viewData('tasks'));
    }

    public function test_it_displays_the_task_creation_form(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.create');
    }


    public function test_it_creates_a_new_task(): void
    {
        $taskData = [
            'title' => 'New Task',
            'description' => 'Task description',
        ];

        $response = $this->post(route('tasks.store'), $taskData);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'description' => 'Task description',
            'user_id' => $this->user->id,
        ]);
    }

    public function test_it_toggles_a_task_status(): void
    {
        $task = Task::factory()->for($this->user)->create(['completed' => false]);

        $response = $this->patch(route('tasks.toggle', $task));

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => true,
        ]);
    }

    public function test_it_deletes_a_task(): void
    {
        $task = Task::factory()->for($this->user)->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_it_prevents_actions_on_tasks_belonging_to_other_users(): void
    {
        $otherUser = User::factory()->create();
        $task = Task::factory()->for($otherUser)->create();

        // Attempt to toggle the task
        $response = $this->patch(route('tasks.toggle', $task));
        $response->assertStatus(403);

        // Attempt to delete the task
        $response = $this->delete(route('tasks.destroy', $task));
        $response->assertStatus(403);
    }
}
