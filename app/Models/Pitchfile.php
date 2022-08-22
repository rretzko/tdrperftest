<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pitchfile extends Model
{
    use HasFactory;

    public function getFilecontenttypedescrAttribute()
    {
        return Filecontenttype::find($this->filecontenttype_id)->descr;
    }

    public function getInstrumentationabbrAttribute()
    {
        return ($this->instrumentation_id)
            ? Instrumentation::find($this->instrumentation_id)->abbr
            : 'all';
    }

    public function getInstrumentationdescrAttribute()
    {
        return ($this->instrumentation_id)
            ? Instrumentation::find($this->instrumentation_id)->descr
            : 'all';
    }
}
