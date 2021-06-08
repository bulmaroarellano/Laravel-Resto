<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Event;
use App\Models\Invoice;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventInvoicesTest extends TestCase
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
    public function it_gets_event_invoices()
    {
        $event = Event::factory()->create();
        $invoices = Invoice::factory()
            ->count(2)
            ->create([
                'event_id' => $event->id,
            ]);

        $response = $this->getJson(route('api.events.invoices.index', $event));

        $response->assertOk()->assertSee($invoices[0]->due_at);
    }

    /**
     * @test
     */
    public function it_stores_the_event_invoices()
    {
        $event = Event::factory()->create();
        $data = Invoice::factory()
            ->make([
                'event_id' => $event->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.events.invoices.store', $event),
            $data
        );

        $this->assertDatabaseHas('invoices', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $invoice = Invoice::latest('id')->first();

        $this->assertEquals($event->id, $invoice->event_id);
    }
}
