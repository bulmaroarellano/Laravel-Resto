<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerInvoicesTest extends TestCase
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
    public function it_gets_customer_invoices()
    {
        $customer = Customer::factory()->create();
        $invoices = Invoice::factory()
            ->count(2)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.invoices.index', $customer)
        );

        $response->assertOk()->assertSee($invoices[0]->due_at);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_invoices()
    {
        $customer = Customer::factory()->create();
        $data = Invoice::factory()
            ->make([
                'customer_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.invoices.store', $customer),
            $data
        );

        $this->assertDatabaseHas('invoices', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $invoice = Invoice::latest('id')->first();

        $this->assertEquals($customer->id, $invoice->customer_id);
    }
}
