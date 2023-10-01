<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Participant;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipantTest extends TestCase
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
    public function it_gets_participants_list()
    {
        $participants = Participant::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.participants.index'));

        $response->assertOk()->assertSee($participants[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_participant()
    {
        $data = Participant::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.participants.store'), $data);

        $this->assertDatabaseHas('participants', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_participant()
    {
        $participant = Participant::factory()->create();

        $data = [
            'church_id' => $this->faker->randomNumber,
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'type' => $this->faker->randomNumber,
            'group' => $this->faker->randomNumber(0),
            'gender' => \Arr::random(['male', 'female', 'other']),
        ];

        $response = $this->putJson(
            route('api.participants.update', $participant),
            $data
        );

        $data['id'] = $participant->id;

        $this->assertDatabaseHas('participants', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_participant()
    {
        $participant = Participant::factory()->create();

        $response = $this->deleteJson(
            route('api.participants.destroy', $participant)
        );

        $this->assertModelMissing($participant);

        $response->assertNoContent();
    }
}
