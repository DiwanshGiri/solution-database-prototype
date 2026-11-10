<?php
namespace Tests\Feature;

use App\Models\Problem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProblemManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_problem_can_be_added_and_updated(): void
    {
        $this->post('/problems', ['name'=>'Slow sales process','description'=>'Initial note'])->assertRedirect();
        $problem = Problem::firstOrFail();
        $this->patch('/problems/'.$problem->id, ['name'=>'Improved sales process','description'=>'Updated note'])->assertRedirect();
        $this->assertDatabaseHas('problems', ['name'=>'Improved sales process']);
    }
}
