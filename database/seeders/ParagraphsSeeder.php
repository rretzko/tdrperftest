<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paragraph;

class ParagraphsSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        //instantiate $this->seeds with guardiantype data
        $this->seeds = $this->buildSeeds();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->seeds AS $seed){

            $model = new Paragraph;

            $model->massmailing_id = $seed[0];
            $model->paragraph = $seed[1];
            $model->order_by = $seed[2];

            $model->save();
        }
    }

    private function buildSeeds()
    {
        return [
            [4,'Thank you all in advance for giving your time on |*concert_date*| at |*venue_name*| for the |*concert_time*| Concert. Your
        help that day will surely contribute to a smooth, effective concert.  Here is what is expected of you when you
        arrive',2],
            [4,'<ul><li>Please be at |*venue_shortname*| no later than |*arrival_time*| to aid with student check-in.</li>
<li>You will assist with keeping the halls quiet while getting students in and out of the auditorium.</li>
<li>While students are on stage, please stand behind the risers to aid in keeping the students quiet and any student
who is not feeling well that may come off the stage.</li>
<li>While not on stage, please stay in the rehearsal room and monitor students in the bathroom, etc.</li>
<li>Aid with check-out and clean-up at the end of the concert.</li>
    </ul>',4],
            [4,'<a href"mailto:|*sender_email*|">Please confirm to me that you have received this email.</a> I will send you a reminder email
a few days prior to the rehearsal.  I hope you enjoyed your Thanksgiving!',5],
            [4,'|*sender_name*|',6],
            [4,'|*sender_title*|',7],
            [4,'|*school_address*|',8],
            [4,'|*sender_email*|',9],
            [4,'|*sender_phone*|',10],
        ];

    }
}
