<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrantscores extends Model
{
    use HasFactory;

    private $componentscores;
    private $registrant;

    protected $fillable = ['registrant'];

   public function __construct(array $attributes = [])
   {
       parent::__construct($attributes);

       $this->registrant = $attributes['registrant'];

       $this->init();
   }

   public function componentscores()
   {
       return $this->componentscores;
   }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private function init()
    {
        $this->componentscores = \App\Models\Score::where('registrant_id', $this->registrant->id)->get();
    }
}
