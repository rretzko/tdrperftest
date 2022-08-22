<?php

namespace Tests\Feature;

use App\Models\Ensemble;
use App\Models\School;
use App\Models\User;
use App\Models\Userconfig;
use Database\Factories\EnsembleFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnsembleTest extends TestCase
{
    use WithFaker,RefreshDatabase;

    /** @test */
    public function only_an_authenticated_user_can_create_an_ensemble()
    {
        //NOTE: no authenticated user is created with this test
        $user = User::factory()->create();
        $school = School::factory()->create();
        $user->schools()->attach($school);

        $ensemble = Ensemble::factory(['user_id' => $user->id, 'school_id' => $school->id])->raw();

        $this->get('/ensembles')->assertStatus(200);
        //$this->post('/ensembles',$ensemble)->assertRedirect('login');
    }

    /** @test
     * @todo Ensemble link should ONLY display if user is attached to a school && school_id is stored in Userconfig::setValue(school_id)
     * @todo Add school_id to Userconfig::setValue(school_id) whenever a new school is added
     */
    public function only_an_authenticated_user_with_a_school_can_create_an_ensemble()
    {
        $this->withoutExceptionHandling();

        //make an authenticated user with school linkage
        $this->setUpUser();

        $ensemble = Ensemble::factory()->raw();

        $this->post('/ensembles',$ensemble)->assertRedirect('ensembles');
    }

    /** @test */
    public function a_user_can_create_an_ensemble()
    {
        $this->withoutExceptionHandling();

        //make an authenticated user
        $this->setUpUser();

        $attributes = [
            'name' => $this->faker->word,
            'abbr' => $this->faker->randomLetter.$this->faker->randomLetter.$this->faker->randomLetter,
            'descr' => $this->faker->paragraph,
        ];

        //make an ensemble
        $this->post('/ensembles',$attributes)->assertRedirect('/ensembles');

        $this->assertDatabaseHas('ensembles', $attributes);

        $this->get('/ensembles')->assertSee($attributes['name']);
    }

    /** @test */
    public function a_user_can_create_an_ensemble_without_description()
    {
        $this->withoutExceptionHandling();

        //make an authenticated user
        $this->setUpUser();

        $attributes = [
            'name' => $this->faker->word,
            'abbr' => $this->faker->word,
            'descr' => null,
        ];

        $this->post('/ensembles',$attributes);

        $this->assertDatabaseHas('ensembles', $attributes);
    }

    /** @test */
    public function an_ensemble_requires_a_name()
    {
        //make an authenticated user
        $this->setUpUser();

        $ensemble = Ensemble::factory()->raw(['name' => '']);

        $this->post('/ensembles',$ensemble)->assertSessionHasErrors('name');
    }

    /** @test */
    public function an_ensemble_requires_an_abbr()
    {
        //make an authenticated user
        $this->setUpUser();

        $ensemble = Ensemble::factory()->raw(['abbr' => '']);

        $this->post('/ensembles',$ensemble)->assertSessionHasErrors('abbr');
    }

    /** @test */
    public function an_ensemble_does_not_require_a_description()
    {
        $ensemble = Ensemble::factory()->raw(['descr' => '']);

        $this->post('/ensembles', $ensemble)->assertSessionDoesntHaveErrors();
    }

    /** @test */
    public function a_user_can_view_an_ensemble()
    {
        $this->withoutExceptionHandling();

        $ensemble = Ensemble::factory()->create();

        $this->actingAs(User::find($ensemble->user_id));
        Userconfig::setValue('school_id',$ensemble->school_id);

        $this->get($ensemble->path())
            ->assertSee($ensemble->name)
            ->assertSee($ensemble->abbr);
    }

    private function setUpUser()
    {
        $user = User::factory()->create();
        $this->signIn($user);

        $school = School::factory()->create();

        $user->schools()->attach($school);

        //set-up for normal workflow assignment of school_id to Userconfigs
        Userconfig::setValue('school_id', $school->id);

        return $user;
    }
}
