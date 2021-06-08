<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_customers_list()
    {
        $customers = Customer::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.customers.index'));

        $response->assertOk()->assertSee($customers[0]->dni);
    }

    /**
     * @test
     */
    public function it_stores_the_customer()
    {
        $data = Customer::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.customers.store'), $data);

        $this->assertDatabaseHas('customers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_customer()
    {
        $customer = Customer::factory()->create();

        $data = [
            'dni' => $this->faker->text(255),
            'firstname' => $this->faker->name,
            'lastname' => $this->faker->text(255),
            'telephone' => $this->faker->tollFreePhoneNumber,
            'email' => $this->faker->email,
            'fiscal_code' => $this->faker->text(255),
            'company_name' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.customers.update', $customer),
            $data
        );

        $data['id'] = $customer->id;

        $this->assertDatabaseHas('customers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->deleteJson(
            route('api.customers.destroy', $customer)
        );

        $this->assertSoftDeleted($customer);

        $response->assertNoContent();
    }
}
