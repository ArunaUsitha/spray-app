<?php

namespace Tests\Feature\Machine;

use App\Models\Machine;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AuthTestCase;

class MachineOperationTest extends AuthTestCase
{
    use RefreshDatabase;

    private Machine $machine;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a machine instance
        $this->machine = Machine::factory()->create();
    }

    public function test_authenticated_users_can_add_hours(): void
    {
        $response = $this->withCredentials()
            ->postJson('/api/machine/operation' , [
                "machine_id" => $this->machine->id,
                "user_id" => $this->user->id,
                "operation_date" => Carbon::today(),
                "operation_hours" => 10
            ]);

        // Assert response status
        $response->assertStatus(201);

        // Assert the machine exists in the database
        $this->assertDatabaseHas('machine_operations', [
            "machine_id" => $this->machine->id,
            "user_id" => $this->user->id,
            "operation_hours" => 10
        ]);
    }

    public function test_authenticated_users_can_reset_hours(): void
    {
        // Add machine hours
        $this->withCredentials()
            ->postJson('/api/machine/operation' , [
                "machine_id" => $this->machine->id,
                "user_id" => $this->user->id,
                "operation_date" => Carbon::today(),
                "operation_hours" => 10
            ]);

        $response = $this->withCredentials()
            ->postJson('/api/machine/operations/reset' , [
                "machine_id" => $this->machine->id,
                "user_id" => $this->user->id,
            ]);

        // Assert response status
        $response->assertStatus(200);

        // Assert the machine exists in the database
        $this->assertDatabaseHas('machine_operations', [
            "machine_id" => $this->machine->id,
            "user_id" => $this->user->id,
            "operation_hours" => 0
        ]);
    }

}
