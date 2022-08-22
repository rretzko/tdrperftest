<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gradetype extends Model
{
    use HasFactory;

    public function ensembles()
    {
        return $this->belongsToMany(Ensemble::class);
    }

    public function schoolUser()
    {
        $a = [];

        foreach(DB::table('gradetype_school_user')
                ->select('gradetype_id')
                ->where('school_id', '=', Userconfig::getValue('school', auth()->id()))
                ->where('user_id', '=', auth()->id())
                ->pluck('gradetype_id') AS $gradetype_id){

            $a[] = Gradetype::find($gradetype_id);

        }

        return (collect($a));
    }
}
