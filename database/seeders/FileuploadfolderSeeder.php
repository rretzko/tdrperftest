<?php

namespace Database\Seeders;

use App\Models\Fileuploadfolder;
use Illuminate\Database\Seeder;

class FileuploadfolderSeeder extends Seeder
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
        foreach($this->seeds AS $seed){

            Fileuploadfolder::create([
               'folder_id' => $seed[0],
               'eventversion_id' => $seed[1],
               'instrumentation_id' => $seed[2],
               'filecontenttype_id' => $seed[3],
               'parent_id' => $seed[4],
               'name' => $seed[5],
            ]);
        }
    }

    private function buildSeeds()
    {
        return [
            ['1f95dabd1a1be692',65,65,7,NULL,'njas-master'],
            ['a895dabd1a1be125',65,65,7,'1f95dabd1a1be692','njas-ai'],
            ['db95dabd1a1be256',65,66,7,'1f95dabd1a1be692','njas-aii'],
            ['db95dabd1a1ae356',65,66,4,'1f95dabd1a1be692','njas-aii-quintet'],
            ['7995dabd1a1ae1f4',65,66,1,'1f95dabd1a1be692','njas-aii-scales'],
            ['a895dabd1a1ae025',65,66,5,'1f95dabd1a1be692','njas-aii-solo'],
            ['4e95dabd1a1ae6c3',65,65,4,'a895dabd1a1be125','njas-ai-quintet'],
            ['1f95dabd1a1ae792',65,65,1,'a895dabd1a1be125','njas-ai-scales'],
            ['ec95dabd1a1ae461',65,65,5,'a895dabd1a1be125','njas-ai-solo'],
            ['bd95dabd1a1ae530',65,70,7,'1f95dabd1a1be692','njas-bii'],
            ['6495dabd1a1bede9',65,69,7,'1f95dabd1a1be692','njas-bi'],
            ['6495dabd1a1aece9',65,69,4,'6495dabd1a1bede9','njas-bi-quintet'],
            ['0a95dabd1a1ae287',65,69,1,'6495dabd1a1bede9','njas-bi-scales'],
            ['3595dabd1a1aedb8',65,69,5,'6495dabd1a1bede9','njas-bi-solo'],
            ['1f95dabd1a15e892',65,70,4,'bd95dabd1a1ae530','njas-bii-quintet'],
            ['bd95dabd1a15ea30',65,70,1,'bd95dabd1a1ae530','njas-bii-scales'],
            ['ec95dabd1a15eb61',65,70,5,'bd95dabd1a1ae530','njas-bii-solo'],
            ['4e95dabd1a1be7c3',65,63,7,'1f95dabd1a1be692','njas-si'],
            ['7995dabd1a1be0f4',65,64,7,'1f95dabd1a1be692','njas-sii'],
            ['3595dabd1a15e2b8',65,64,4,'7995dabd1a1be0f4','njas-sii-quintet'],
            ['db95dabd1a15ec56',65,64,1,'7995dabd1a1be0f4','njas-sii-scales'],
            ['0a95dabd1a15ed87',65,64,5,'7995dabd1a1be0f4','njas-sii-solo'],
            ['a895dabd1a15ef25',65,63,4,'4e95dabd1a1be7c3','njas-si-quintet'],
            ['4e95dabd1a15e9c3',65,63,1,'4e95dabd1a1be7c3','njas-si-scales'],
            ['7995dabd1a15eef4',65,63,5,'4e95dabd1a1be7c3','njas-si-solo'],
            ['0a95dabd1a1be387',65,67,7,'1f95dabd1a1be692','njas-ti'],
            ['3595dabd1a1becb8',65,68,7,'1f95dabd1a1be692','njas-tii'],
            ['7995dabd1a14eff4',65,68,4,'3595dabd1a1becb8','njas-tii-quintet'],
            ['1f95dabd1a14e992',65,68,1,'3595dabd1a1becb8','njas-tii-scales'],
            ['4e95dabd1a14e8c3',65,68,5,'3595dabd1a1becb8','njas-tii-solo'],
            ['ec95dabd1a14ea61',65,67,4,'0a95dabd1a1be387','njas-ti-quintet'],
            ['6495dabd1a15e3e9',65,67,1,'0a95dabd1a1be387','njas-ti-scales'],
            ['bd95dabd1a14eb30',65,67,5,'0a95dabd1a1be387','njas-ti-solo'],
        ];
    }
}
