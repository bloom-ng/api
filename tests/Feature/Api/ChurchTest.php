<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Church;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChurchTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_churches_list()
    {
        $churches = Church::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.churches.index'));

        $response->assertOk()->assertSee($churches[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_church()
    {
        $data = Church::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.churches.store'), $data);

        $this->assertDatabaseHas('churches', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_church()
    {
        $church = Church::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.churches.update', $church),
            $data
        );

        $data['id'] = $church->id;

        $this->assertDatabaseHas('churches', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_church()
    {
        $church = Church::factory()->create();

        $response = $this->deleteJson(route('api.churches.destroy', $church));

        $this->assertModelMissing($church);

        $response->assertNoContent();
    }
}
