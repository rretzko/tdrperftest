<?php

namespace Database\Seeders;

use App\Models\Instrumentation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstrumentationSeeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        $this->seeds = $this->instrumentations();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        foreach($this->seeds AS $seed) {

            $model = new Instrumentation;

            $model->create([
                'id' => $seed[0],
                'descr' => $seed[1],
                'abbr' => $seed[2],
                'instrumentationbranch_id' => $seed[3],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    private function instrumentations()
    {
        return [
            [1,'alto','alt',1],
            [2,'baritone','bar',1],
            [3,'bass','bass',1],
            [4,'bass baritone','bbar',1],
            [5,'soprano','sop',1],
            [6,'tenor','ten',1],
            [7,'accordion','acc',2],
            [8,'alto flute','afl',2],
            [9,'bagpipe','bag',2],
            [10,'continuo','bc',2],
            [11,'bass clarinet','bcl',2],
            [12,'bell chimes','bell',2],
            [13,'bass flute','bfl',2],
            [14,'bass guitar','bgtr',2],
            [15,'banjo','bjo',2],
            [16,'bassoon','bn',2],
            [17,'bass oboe','bob',2],
            [18,'bugle','bug',2],
            [19,'contrabass clarinet','cbcl',2],
            [20,'contrabassoon','cbn',2],
            [21,'celesta','cel',2],
            [22,'clarinet','cl',2],
            [23,'cornet','crt',2],
            [24,'double bass','db',2],
            [25,'dulcimer','dulc',2],
            [26,'electric guitar','egtr',2],
            [27,'english horn','eh',2],
            [28,'euphonium','euph',2],
            [29,'flugelhorm','fgh',2],
            [30,'fife','fife',2],
            [31,'flute','fl',2],
            [32,'glockenspiel','gl',2],
            [33,'guitar','gtr',2],
            [34,'harmonica','hca',2],
            [35,'horn','hn',2],
            [36,'harp','hp',2],
            [37,'mandolin','mand',2],
            [38,'marimba','mar',2],
            [39,'oboe','ob',2],
            [40,'organ','org',2],
            [41,'percussion','perc',2],
            [42,'piano','pf',2],
            [43,'piccolo','picc',2],
            [44,'timpani','timp',2],
            [45,'recorder','rec',2],
            [46,'saxophone','sax',2],
            [47,'tuba','tba',2],
            [48,'trombone','tbn',2],
            [49,'theremin','thrm',2],
            [50,'trumpet','tpt',2],
            [51,'ukelele','uke',2],
            [52,'viola','va',2],
            [53,'cello','vc',2],
            [54,'vibraphone','vib',2],
            [55,'violin','vn',2],
            [56,'xlyophone','xyl',2],
            [57,'zither','zith',2],
            [58,'alto saxophone','asax',2],
            [59,'baritone saxophone','brsx',2],
            [60,'bass saxophone','basx',2],
            [61,'tenor saxophone','tsax',2],
            [62,'soprano saxophone','ssax',2],
            [63,'soprano i','si',1],
            [64,'soprano ii','sii',1],
            [65,'alto i','ai',1],
            [66,'alto ii','aii',1],
            [67,'tenor i','ti',1],
            [68,'tenor ii','tii',1],
            [69,'bass i','bi',1],
            [70,'bass ii','bii',1],
            [71,'descant','des',1],
        ];
    }
}
