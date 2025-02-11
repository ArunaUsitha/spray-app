<?php

namespace Tests\Feature\Machine;

use App\Models\Machine;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AuthTestCase;
use Tests\TestCase;
use Tests\Traits\WithAuthToken;

class MachineTest extends AuthTestCase
{
    use RefreshDatabase;

    private $machine;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a machine instance
        $this->machine = Machine::factory()->create();
    }

    public function test_authenticated_users_can_create_machines(): void
    {
        $response = $this->withCredentials()
            ->postJson('/api/machine', [
                'name' => $this->machine->name . random_int(1,5),
                'model' => $this->machine->model,
                'brand' => $this->machine->brand,
                'purchase_date' => $this->machine->purchase_date,
                'purchase_price' => $this->machine->purchase_price,
            ]);

        // Assert response status
        $response->assertStatus(201);

        // Assert the machine exists in the database
        $this->assertDatabaseHas('machines', [
            'name' => $this->machine->name,
            'brand' => $this->machine->brand,
            'purchase_date' => $this->machine->purchase_date,
            'purchase_price' => $this->machine->purchase_price,
        ]);
    }

    public function test_authenticated_users_can_get_machines_list(): void
    {
        $response = $this->withCredentials()
            ->getJson('/api/machine');

        // Assert response status
        $response->assertStatus(200);
        $response->assertJsonStructure([ '*' => [
            'id',
            'name',
            'model',
            'brand',
            'purchase_date',
            'purchase_price',
            'reset_count',
            'total_operation_hours',
            'created_at',
            'updated_at',
        ]]);

    }

    public function test_authenticated_users_can_edit_machine(): void
    {
        $updatedData = [
            'name' => $this->machine->name . ' edited',
            'model' => $this->machine->model,
            'brand' => $this->machine->brand,
            'purchase_date' => $this->machine->purchase_date,
            'purchase_price' => $this->machine->purchase_price,
        ];

        $response = $this->withCredentials()
            ->putJson('/api/machine/' . $this->machine->id, $updatedData);

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $this->machine->id,
            'name' => $updatedData['name'],
            'model' => $updatedData['model'],
            'brand' => $updatedData['brand'],
            'purchase_date' => $updatedData['purchase_date'],
            'purchase_price' => $updatedData['purchase_price'],
        ]);

        $this->assertDatabaseHas('machines', [
            'id' => $this->machine->id,
            'name' => $updatedData['name'],
            'model' => $this->machine->model,
            'brand' => $this->machine->brand,
            'purchase_price' => $this->machine->purchase_price,
        ]);
    }

    public function test_authenticated_users_can_get_a_single_machine(): void
    {
        $response = $this->withCredentials()
            ->getJson('/api/machine/' . $this->machine->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'model',
            'brand',
            'purchase_date',
            'purchase_price',
            'reset_count',
            'total_operation_hours',
            'created_at',
            'updated_at',
        ]);

    }

    public function test_authenticated_users_can_delete_a_single_machine(): void
    {
        $response = $this->withCredentials()
            ->delete('/api/machine/' . $this->machine->id);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => 1,
        ]);

    }
}
