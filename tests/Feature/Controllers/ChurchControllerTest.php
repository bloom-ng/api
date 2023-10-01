<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Church;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChurchControllerTest extends TestCase
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
    public function it_displays_index_view_with_churches()
    {
        $churches = Church::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('churches.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.churches.index')
            ->assertViewHas('churches');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_church()
    {
        $response = $this->get(route('churches.create'));

        $response->assertOk()->assertViewIs('app.churches.create');
    }

    /**
     * @test
     */
    public function it_stores_the_church()
    {
        $data = Church::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('churches.store'), $data);

        $this->assertDatabaseHas('churches', $data);

        $church = Church::latest('id')->first();

        $response->assertRedirect(route('churches.edit', $church));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_church()
    {
        $church = Church::factory()->create();

        $response = $this->get(route('churches.show', $church));

        $response
            ->assertOk()
            ->assertViewIs('app.churches.show')
            ->assertViewHas('church');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_church()
    {
        $church = Church::factory()->create();

        $response = $this->get(route('churches.edit', $church));

        $response
            ->assertOk()
            ->assertViewIs('app.churches.edit')
            ->assertViewHas('church');
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

        $response = $this->put(route('churches.update', $church), $data);

        $data['id'] = $church->id;

        $this->assertDatabaseHas('churches', $data);

        $response->assertRedirect(route('churches.edit', $church));
    }

    /**
     * @test
     */
    public function it_deletes_the_church()
    {
        $church = Church::factory()->create();

        $response = $this->delete(route('churches.destroy', $church));

        $response->assertRedirect(route('churches.index'));

        $this->assertModelMissing($church);
    }
}
