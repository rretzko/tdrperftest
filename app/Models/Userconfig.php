<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Userconfig extends Model
{
    use HasFactory;

    static public function getValue($descr, $user_id)
    {
        return (self::exists($descr,$user_id)) //if the $descr exists for $user_id
            ? self::get($descr,$user_id) //return that value, otherwise
            : self::default($descr,$user_id); //create the $descr row from known data and then return that value
    }

    static public function setValue($descr, $user_id, $value)
    {
        if(! self::exists($descr,$user_id)){
            self::defaultSave($descr, $user_id, $value);
        }else{
            self::defaultUpdate($descr, $user_id, $value);
        }
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private static function default($descr, $user_id)
    {
        $method = 'default'.ucfirst($descr);

        self::$method($descr, $user_id);

        return self::get($descr, $user_id);
    }

    private static function defaultFilter_studentroster($descr, $user_id)
    {
        $user = User::find($user_id);
        self::defaultSave($descr, $user_id, 'all');
    }

    private static function defaultPagedef_students($descr, $user_id)
    {
        self::defaultSave($descr, $user_id, 1); //display
    }

    private static function defaultPagination($descr, $user_id)
    {
        self::defaultSave($descr, $user_id, 4);
    }

    private static function defaultSave($descr, $user_id, $value)
    {
        DB::table('userconfigs')
            ->insert([
                'descr' => $descr,
                'user_id' => $user_id,
                'value' => $value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    }

    private static function defaultSchool_id($descr, $user_id)
    {
        $user = User::find($user_id);
        $school = $user->schools->first();
        self::defaultSave($descr, $user_id, $school->id);
    }

    private static function defaultEnsemble_id($descr, $user_id)
    {
        $person = Person::find($user_id);
        $ensemble = $person->ensembles->first();
        self::defaultSave($descr, $user_id, $ensemble->id);
    }

    private static function defaultEventversion($descr, $user_id)
    {
        self::defaultSave($descr, $user_id, -1);
    }

    private static function defaultGettingstarted($descr, $user_id)
    {
        //defaults to true so that a new user is seen as needing
        //to read 'Getting Started' doc.
        self::defaultSave($descr, $user_id, 1);
    }

    private static function defaultRegistrantpopulation($descr, $user_id)
    {
        self::defaultSave($descr, $user_id, 'eligible');
    }


    private static function defaultSchool($descr, $user_id)
    {
        $user = User::find($user_id);
        $school = $user->schools->first();
        self::defaultSave($descr, $user_id, $school->id);
    }

    private static function defaultSchoolyear_id($descr, $user_id)
    {
        //initializes the schoolyear_id corresponding to the current YYYY
        self::defaultSave($descr, $user_id, date('Y'));
    }

    private static function defaultStudentform($descr, $user_id)
    {
        self::defaultSave($descr, $user_id, 'biography');
    }

    private static function defaultStudentform_tab($descr, $user_id)
    {
        self::defaultSave($descr, $user_id, 'biography'); //display
    }

    private static function defaultStudenttab($descr, $user_id)
    {
        self::defaultSave($descr, $user_id, 'biography');
    }

    private static function defaultStudentpopulation($descr, $user_id)
    {
        self::defaultSave($descr, $user_id, 'all');
    }

    private static function defaultUpdate($descr, $user_id, $value)
    {
        DB::table('userconfigs')
                ->where('user_id', $user_id)
                ->where('descr',$descr)
                ->update([
                    'value' => $value,
                    'updated_at' => Carbon::now(),
                ]);
    }

    private static function exists($descr, $user_id)
    {
        return DB::table('userconfigs')
            ->where('user_id', '=', $user_id)
            ->where('descr', '=', $descr)
            ->exists();
    }

    private static function get($descr, $user_id)
    {
        return DB::table('userconfigs')
            ->where('user_id', '=', $user_id)
            ->where('descr', '=', $descr)
            ->value('value');
    }


}
