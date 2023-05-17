<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    // If you use the WithFaker trait, you get access to fake() to create random data, as you would in factories
    // Refresh database is used to start a test with a clean database - it turns everything back to its original state
    use WithFaker, RefreshDatabase;

    public function test_only_authenticated_users_can_create_projects(): void
    {
        // this is useful to trace the validation exception, when you're still fixing the test / controller etc, but once you've made the changes, you need to disable it.
        // $this->withoutExceptionHandling();
        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('/login');
    }

    public function test_a_user_can_create_a_project(): void
    {
        // by default, laravel will catch the exception and handle it gracefully. We actually want to see the exception in tests.
        // $this->withoutExceptionHandling();
        // save the attributes of the project to an array
        $attributes = [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
        ];

        // Check that you can post data for a project with the above attributes
        $this->actingAs(User::factory()->create())->post('/projects', $attributes)->assertRedirect('/projects');

        // *Note* Tests will use the 'testing' database instead of the 'birdboard' database - the name of the db can be found in phpunit.xml <env name="DB_DATABASE" value="testing"/>
        // If you want to use a virtual db, that doesn't store anything in the db and just creates it in memory, you can use <env name="DB_DATABASE" value=":memory:"/>
        // Check if project exists in db
        $this->assertDatabaseHas('projects', $attributes);

        // If I make get request to the projects route, I expect to see the project title that i've just saved
        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_a_project_requires_a_title(): void
    {
        // create() will store it in the db, make() will not store it in the db and raw() will use the raw array keys and values, instead of an object
        $attributes = Project::factory()->raw(['title' => '']);
        // if I'm going to give it an empty title in the request, I expect to see (validation) errors
        $this->actingAs(User::factory()->create())->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description(): void
    {
        $attributes = Project::factory()->raw(['description' => '']);
        // if I'm going to give it an empty description in the request, I expect to see (validation) errors
        $this->actingAs(User::factory()->create())->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_a_user_can_view_a_project(): void
    {
        $this->withoutExceptionHandling();
        // create a project
        $project = Project::factory()->create();
        // if i go to that project's page, I expect to see the title and the description
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }


}
