<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scoringcomponent extends Model
{
    use HasFactory;
    
    protected $fillable = ['abbr', 'bestscore','descr','eventversion_id', 'filecontenttype_id','interval','order_by','tolerance','worstscore',];
}
