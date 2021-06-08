<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Menu;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuTest extends TestCase
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
    public function it_gets_menus_list()
    {
        $menus = Menu::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.menus.index'));

        $response->assertOk()->assertSee($menus[0]->article);
    }

    /**
     * @test
     */
    public function it_stores_the_menu()
    {
        $data = Menu::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.menus.store'), $data);

        $this->assertDatabaseHas('menus', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_menu()
    {
        $menu = Menu::factory()->create();

        $data = [
            'article' => $this->faker->text(255),
            'description' => $this->faker->sentence(15),
            'code' => $this->faker->text(255),
            'price' => $this->faker->randomFloat(2, 0, 9999),
        ];

        $response = $this->putJson(route('api.menus.update', $menu), $data);

        $data['id'] = $menu->id;

        $this->assertDatabaseHas('menus', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_menu()
    {
        $menu = Menu::factory()->create();

        $response = $this->deleteJson(route('api.menus.destroy', $menu));

        $this->assertSoftDeleted($menu);

        $response->assertNoContent();
    }
}
