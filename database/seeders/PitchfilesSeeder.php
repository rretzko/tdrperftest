<?php

namespace Database\Seeders;

use App\Models\Pitchfile;
use Illuminate\Database\Seeder;

class PitchfilesSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        $this->seeds = $this->buildSeeds();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->seeds AS $seed)
        {
            Pitchfile::create([
               'eventversion_id' => $seed['eventversion_id'],
               'filecontenttype_id' => $seed['filecontenttype_id'],
               'instrumentation_id' => $seed['instrumentation_id'],
               'location' => $seed['location'],
               'descr' => $seed['descr'],
            ]);
        }
    }

    private function buildSeeds()
    {
        return [
            //ALL INSTRUMENTATIONS
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 4,
                'instrumentation_id' => NULL,
                'location' => '/assets/pitchfiles/9/65/quintet/all/all-quintet-full-ensemble.mp3',
                'descr' => 'Full Ensemble'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 4,
                'instrumentation_id' => NULL,
                'location' => '/assets/pitchfiles/9/65/quintet/all/all-quintet-sheet-music.pdf',
                'descr' => 'Sheet music'
            ],
            //SOPRANO I
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 63,
                'location' => '/assets/pitchfiles/9/65/scales/si/soprano_i-scales-high-scale.mp3',
                'descr' => 'High Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 63,
                'location' => '/assets/pitchfiles/9/65/scales/si/soprano_i-scales-low-scale.mp3',
                'descr' => 'Low Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 63,
                'location' => '/assets/pitchfiles/9/65/scales/si/soprano_i-scales-chromatic-scale.mp3',
                'descr' => 'Chromatic Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 5,
                'instrumentation_id' => 63,
                'location' => '/assets/pitchfiles/9/65/solo/si/soprano_i-solo-shenandoah.mp3',
                'descr' => 'Shenandoah'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 4,
                'instrumentation_id' => 63,
                'location' => '/assets/pitchfiles/9/65/quintet/si/soprano_i-quintet-without-si.mp3',
                'descr' => 'Without SI'
            ],
            //SOPRANO II
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 64,
                'location' => '/assets/pitchfiles/9/65/scales/sii/soprano_ii-scales-high-scale.mp3',
                'descr' => 'High Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 64,
                'location' => '/assets/pitchfiles/9/65/scales/sii/soprano_ii-scales-low-scale.mp3',
                'descr' => 'Low Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 64,
                'location' => '/assets/pitchfiles/9/65/scales/sii/soprano_ii-scales-chromatic-scale.mp3',
                'descr' => 'Chromatic Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 5,
                'instrumentation_id' => 64,
                'location' => '/assets/pitchfiles/9/65/solo/sii/soprano_ii-solo-shenandoah.mp3',
                'descr' => 'Shenandoah'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 4,
                'instrumentation_id' => 64,
                'location' => '/assets/pitchfiles/9/65/quintet/sii/soprano_ii-quintet-without-sii.mp3',
                'descr' => 'Without SII'
            ],
            //ALTO I
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 65,
                'location' => '/assets/pitchfiles/9/65/scales/ai/alto_i-scales-high-scale.mp3',
                'descr' => 'High Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 65,
                'location' => '/assets/pitchfiles/9/65/scales/ai/alto_i-scales-low-scale.mp3',
                'descr' => 'Low Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 65,
                'location' => '/assets/pitchfiles/9/65/scales/ai/alto_i-scales-chromatic-scale.mp3',
                'descr' => 'Chromatic Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 5,
                'instrumentation_id' => 65,
                'location' => '/assets/pitchfiles/9/65/solo/ai/alto_i-solo-shenandoah.mp3',
                'descr' => 'Shenandoah'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 4,
                'instrumentation_id' => 65,
                'location' => '/assets/pitchfiles/9/65/quintet/ai/alto_i-quintet-without-alto.mp3',
                'descr' => 'Without Alto'
            ],
            //ALTO II
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 66,
                'location' => '/assets/pitchfiles/9/65/scales/aii/alto_ii-scales-high-scale.mp3',
                'descr' => 'High Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 66,
                'location' => '/assets/pitchfiles/9/65/scales/aii/alto_ii-scales-low-scale.mp3',
                'descr' => 'Low Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 66,
                'location' => '/assets/pitchfiles/9/65/scales/aii/alto_ii-scales-chromatic-scale.mp3',
                'descr' => 'Chromatic Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 5,
                'instrumentation_id' => 66,
                'location' => '/assets/pitchfiles/9/65/solo/aii/alto_ii-solo-shenandoah.mp3',
                'descr' => 'Shenandoah'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 4,
                'instrumentation_id' => 66,
                'location' => '/assets/pitchfiles/9/65/quintet/aii/alto_ii-quintet-without-alto.mp3',
                'descr' => 'Without Alto'
            ],
            //TENOR I
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 67,
                'location' => '/assets/pitchfiles/9/65/scales/ti/tenor_i-scales-high-scale.mp3',
                'descr' => 'High Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 67,
                'location' => '/assets/pitchfiles/9/65/scales/ti/tenor_i-scales-low-scale.mp3',
                'descr' => 'Low Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 67,
                'location' => '/assets/pitchfiles/9/65/scales/ti/tenor_i-scales-chromatic-scale.mp3',
                'descr' => 'Chromatic Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 5,
                'instrumentation_id' => 67,
                'location' => '/assets/pitchfiles/9/65/solo/ti/tenor_i-solo-shenandoah.mp3',
                'descr' => 'Shenandoah'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 4,
                'instrumentation_id' => 67,
                'location' => '/assets/pitchfiles/9/65/quintet/ti/tenor_i-quintet-without-tenor.mp3',
                'descr' => 'Without Tenor'
            ],
            //TENOR II
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 68,
                'location' => '/assets/pitchfiles/9/65/scales/tii/tenor_ii-scales-high-scale.mp3',
                'descr' => 'High Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 68,
                'location' => '/assets/pitchfiles/9/65/scales/tii/tenor_ii-scales-low-scale.mp3',
                'descr' => 'Low Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 68,
                'location' => '/assets/pitchfiles/9/65/scales/tii/tenor_ii-scales-chromatic-scale.mp3',
                'descr' => 'Chromatic Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 5,
                'instrumentation_id' => 68,
                'location' => '/assets/pitchfiles/9/65/solo/tii/tenor_ii-solo-shenandoah.mp3',
                'descr' => 'Shenandoah'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 4,
                'instrumentation_id' => 68,
                'location' => '/assets/pitchfiles/9/65/quintet/tii/tenor_ii-quintet-without-tenor.mp3',
                'descr' => 'Without Tenor'
            ],
            //BASS I
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 69,
                'location' => '/assets/pitchfiles/9/65/scales/bi/bass_i-scales-high-scale.mp3',
                'descr' => 'High Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 69,
                'location' => '/assets/pitchfiles/9/65/scales/bi/bass_i-scales-low-scale.mp3',
                'descr' => 'Low Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 69,
                'location' => '/assets/pitchfiles/9/65/scales/bi/bass_i-scales-chromatic-scale.mp3',
                'descr' => 'Chromatic Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 5,
                'instrumentation_id' => 69,
                'location' => '/assets/pitchfiles/9/65/solo/bi/bass_i-solo-shenandoah.mp3',
                'descr' => 'Shenandoah'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 4,
                'instrumentation_id' => 69,
                'location' => '/assets/pitchfiles/9/65/quintet/bi/bass_i-quintet-without-bass.mp3',
                'descr' => 'Without Bass'
            ],
            //BASS II
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 70,
                'location' => '/assets/pitchfiles/9/65/scales/bii/bass_ii-scales-high-scale.mp3',
                'descr' => 'High Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 70,
                'location' => '/assets/pitchfiles/9/65/scales/bii/bass_ii-scales-low-scale.mp3',
                'descr' => 'Low Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 1,
                'instrumentation_id' => 70,
                'location' => '/assets/pitchfiles/9/65/scales/bii/bass_ii-scales-chromatic-scale.mp3',
                'descr' => 'Chromatic Scale'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 5,
                'instrumentation_id' => 70,
                'location' => '/assets/pitchfiles/9/65/solo/bii/bass_ii-solo-shenandoah.mp3',
                'descr' => 'Shenandoah'
            ],
            [
                'eventversion_id' => 65,
                'filecontenttype_id' => 4,
                'instrumentation_id' => 70,
                'location' => '/assets/pitchfiles/9/65/quintet/bii/bass_ii-quintet-without-bass.mp3',
                'descr' => 'Without Bass'
            ],
        ];
    }
}
