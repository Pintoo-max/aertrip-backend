<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Department;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\Eloquent\EmployeeRepository;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Force the binding for tests
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );
    }

    /** @test */
    public function employee_can_be_created_successfully()
    {

        $department = Department::create([
            'department_name' => 'Engineering',
            'department_description' => 'Tech Department'
        ]);

        $response = $this
        ->postJson('/api/employees', [
            'first_name' => 'Pintoo',
            'last_name'  => 'Chauhan',
            'email'      => 'pintoo@test.com',
            'department_id' => $department->id,
            'contacts' => [
                [
                    'contact_number' => '9999999999',
                    'type' => 'personal'
                ]
            ],
            'addresses' => [
                [
                    'address' => 'Mumbai',
                    'city' => 'Mumbai',
                    'state' => 'MH',
                    'pincode' => '400601',
                    'country' => 'India'
                ]
            ]
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'department',
                    'contacts',
                    'addresses'
                ]
            ]);

        $this->assertDatabaseHas('employees', [
            'email' => 'pintoo@test.com'
        ]);
    }
}
