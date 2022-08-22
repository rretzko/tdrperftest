<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Ensemble extends Model
{
    use HasFactory, SoftDeletes;

    public $schoolyear_id;

    protected $fillable = ['abbr', 'descr', 'ensembletype_id', 'name', 'school_id', 'startyear', 'user_id',];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->schoolyear_id = Userconfig::getValue('schoolyear_id', auth()->id());
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class)
            ->withTimestamps()
            ->orderBy('descr');
    }

    public function delete()
    {
        DB::table('ensemble_gradetype')
            ->where('ensemble_id', '=', $this->id)
            ->update(['deleted_at' => now()]);

        parent::delete();
    }

    public function ensembletype()
    {
        return $this->belongsTo(Ensembletype::class);
    }

    public function ensemblemembers()
    {
        return $this->hasMany(Ensemblemember::class)
            ->with( 'instrumentation','person', 'schoolyear')
            ->where('schoolyear_id', $this->schoolyear_id);
    }

    /**
     * Return a minimal data set to build the ensemble member roster
     */
    public function ensemblememberRosterIds()
    {
        $operator = ($this->schoolyear_id) ? '='  : '>';

        $res = DB::table('ensemblemembers')
            ->where('ensemble_id', '=', $this->id)
            ->where('schoolyear_id', $operator, $this->schoolyear_id)
            ->pluck('id');

        return Ensemblemember::whereIn('id', $res)->with('person', 'ensemble','schoolyear')
            ->get()
            ->sortBy(['person.last','person.first']);

    }

    /**
     * @return simple array of gradetype_ids
     */
    public function gradetypeIdsArray()
    {
        $a = [];

        foreach($this->gradetypes AS $gradetype){

            $a[] = $gradetype->id;
        }

        return $a;
    }

    public function gradetypes()
    {
        return $this->belongsToMany(Gradetype::class)
            ->withTimestamps();
    }

    public function instrumentations()
    {
        return Ensembletype::find($this->ensembletype_id)->instrumentations;
    }

    /**
     * Return the count of unique members over the lifetime of the ensemble
     */
    public function lifetimeCount()
    {
        return DB::table('ensemblemembers')
            ->where('ensemble_id', '=', $this->id)
            ->whereNull('deleted_at')
            ->distinct()
            ->count('user_id');
    }

    /**
     * Return Ensemblemembers for $schoolyear OR
     * all Ensemblemembers for all years if $schoolyear === null
     *
     * @param Schoolyear|null $schoolyear
     * @return Builder[]|Collection
     */
    public function members()
    {
        $members = $this->ensemblemembers->filter(function($member) {
            return ($this->schoolyear_id)
                ? (($member->schoolyear_id == $this->schoolyear_id) && (is_null($this->deleted_at)))
                : $member->schoolyear_id > 0;
        });

        return $members->sortBy('person.last');
    }

    public function nonmembers()
    {
        return Teacher::find(auth()->id())->myStudents()->filter(function($student){

            return (! $student->person->ensembles->contains($this));
        });
    }

    /**
     * Return the count of unique members over the lifetime of the ensemble
     */
    public function schoolyearCount()
    {
        return DB::table('ensemblemembers')
        ->where('ensemble_id', '=', $this->id)
        ->where('schoolyear_id', '=', $this->schoolyear_id) //Userconfig::getValue('schoolyear_id', auth()->id()))
            ->whereNull('deleted_at')
            ->distinct()
        ->count('user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
