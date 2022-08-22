<?php

namespace Tests\Unit;

use App\Models\Ensemble;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnsembleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ensemble_has_path()
    {
        $ensemble = Ensemble::factory()->create();

        $this->assertEquals('/ensemble/'.$ensemble->id, $ensemble->path());
    }
}
