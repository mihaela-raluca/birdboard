<?php

namespace Tests\Unit;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
// The TestCase namespace needs to be changed when creating a new unit test, as it uses PHPUnit\Framework\TestCase, which will cause the test to fail with the error: Call to a member function connection() on null
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test to ensure the path() method returns the expected id
     */
    public function test_it_has_a_path(): void
    {
        $project = Project::factory()->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }
}
