<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Participant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipantControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_participants()
    {
        $participants = Participant::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('participants.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.participants.index')
            ->assertViewHas('participants');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_participant()
    {
        $response = $this->get(route('participants.create'));

        $response->assertOk()->assertViewIs('app.participants.create');
    }

    /**
     * @test
     */
    public function it_stores_the_participant()
    {
        $data = Participant::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('participants.store'), $data);

        $this->assertDatabaseHas('participants', $data);

        $participant = Participant::latest('id')->first();

        $response->assertRedirect(route('participants.edit', $participant));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_participant()
    {
        $participant = Participant::factory()->create();

        $response = $this->get(route('participants.show', $participant));

        $response
            ->assertOk()
            ->assertViewIs('app.participants.show')
            ->assertViewHas('participant');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_participant()
    {
        $participant = Participant::factory()->create();

        $response = $this->get(route('participants.edit', $participant));

        $response
            ->assertOk()
            ->assertViewIs('app.participants.edit')
            ->assertViewHas('participant');
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

        $response = $this->put(
            route('participants.update', $participant),
            $data
        );

        $data['id'] = $participant->id;

        $this->assertDatabaseHas('participants', $data);

        $response->assertRedirect(route('participants.edit', $participant));
    }

    /**
     * @test
     */
    public function it_deletes_the_participant()
    {
        $participant = Participant::factory()->create();

        $response = $this->delete(route('participants.destroy', $participant));

        $response->assertRedirect(route('participants.index'));

        $this->assertModelMissing($participant);
    }
}
