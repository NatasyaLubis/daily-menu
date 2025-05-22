<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Task;
use App\Models\Tag;

class FeatureTodoTest extends TestCase
{
    use RefreshDatabase; 

    public function testStoreDataActivity()
    {
        $response = $this->get(route('dashboard'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Enter an activity');

        $data = [
            'item' => 'Testing',
        ];
        $storeData = $this->post(route('item.store'), $data);

        $storeData->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('tasks', [
            'name' => 'Testing',
        ]);


        $storeData->assertRedirect(route('dashboard'));
    }

    public function testStoreDataActivityWithTag()
    {

        $response = $this->get(route('dashboard'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Enter an activity');

        $data = [
            'item' => 'Testing With Tag|tag1',
        ];
        $storeData = $this->post(route('item.store'), $data);

        $storeData->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('tasks', [
            'name' => 'Testing With Tag',
        ]);
        $this->assertDatabaseHas('tags', [
            'tag_name' => 'tag1',
        ]);

        $storeData->assertRedirect(route('dashboard'));
    }

    public function testDeleteDataActivity()
    {

        $task = Task::create([
            'name' => 'To Be Deleted',
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
        ]);

        $response = $this->delete(route('item.destroy', ['id' => $task->id]));

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);


        $response->assertRedirect(route('dashboard'));
    }
}
