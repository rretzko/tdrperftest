<?php

namespace App\Models;

use App\Traits\SenioryearTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Teacher extends Model
{
    use HasFactory, SenioryearTrait;

    protected $fillable = ['user_id'];
    protected $primaryKey = 'user_id';

    public function getGradetypeIds(School $school)
    {
        return DB::table('gradetype_school_user')
                ->select('gradetype_id')
                ->where('school_id', '=', $school->id)
                ->where('user_id', '=', auth()->id())
                ->get() ?: 0;
    }

    public function getOpenEventversionsAttribute()
    {
        $eventversionids = Eventversiondate::where('datetype_id', Datetype::MEMBERSHIP_CLOSE)
            ->where('dt','>=',Carbon::now())
            ->pluck('eventversion_id');

        $potentials = Eventversion::find($eventversionids);

        $eventversions = $potentials->filter(function($eventversion) {

            $organization = Organization::find($eventversion->event->organization_id);

            return $organization->isMember(auth()->id());
        });

        return $eventversions;

    }

    public function hasGradetype(School $school, $gradetype_id) : bool
    {
        return DB::table('gradetype_school_user')
            ->where('gradetype_id', '=', $gradetype_id)
            ->where('school_id', '=', $school->id)
            ->where('user_id', '=', auth()->id())
            ->value('id') ?? 0;
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'user_id', 'user_id');
    }

    /**
     * Return the School object for the currently selected school
     */
    public function school()
    {
        return School::find(Userconfig::getValue('school', auth()->id()));
    }

    /**
     * @return Students of $this
     */
    public function myStudents($search = '', $first='', $instrumentation_id=0, $classof=0, $school=false)
    {
        $query = Student::with('person', 'person.user.instrumentations','person.ensembles')
            ->whereHas('teachers', function($query){
                return $query->where('user_id', '=', auth()->id());
            })
            ->whereHas('person', function($query) use ($search){
                return $query->where('last', 'LIKE', '%'.$search.'%');
            })
            ->whereHas('person', function($query) use ($first){
                return $query->where('first', 'LIKE', '%'.$first.'%');

            });

        if($instrumentation_id){

            $query->whereHas('person.user.instrumentations', function ($query) use ($instrumentation_id) {

                    return $query->where('instrumentation_id', '=', $instrumentation_id);
                });
        }

        if($classof){

            $query->where('classof', '=', $classof);
        }

        if($school){
            $school_id = Userconfig::getValue('school', auth()->id());

            $query->whereHas('person.user.schools', function($query) use ($school_id){
               return $query->where('school_id', '=', $school_id);
            });
        }

        return $query->get()
        ->sortBy(['person.last','person.first']);
    }

    public function removeStudents(array $ids)
    {
        DB::table('student_teacher')
            ->where('teacher_user_id', '=', $this->user_id)
            ->whereIn('student_user_id', $ids)
            ->delete();
    }

    public function tenures()
    {
        return $this->hasMany(Tenure::class, 'user_id', 'user_id');
    }

    public function saveGradetype(School $school, $gradetype_id, bool $value)
    {
        ($value)
            ? $this->GradetypeAdd($school, $gradetype_id)
            : $this->GradetypeRemove($school, $gradetype_id);
    }

    /**
     * Return collection of students of $this based on $search criteria
     *
     * @param string $search
     * @return Collection
     */
    public function students($search='')
    {
        $a = [];

        //filter students by all, alum or current status
        $filter = Userconfig::getValue('filter_studentroster', $this->user_id);

        //define the current senior year
        $sr_year = $this->senioryear();

        $operator = ($filter === 'alum') ? '<' : '>';
        $value = ($filter === 'all') ? 0 : (($filter === 'alum') ? $sr_year : ($sr_year - 1));//(filter === current)

        //id of current school
        $school_id = $this->school()->id;

        //returns array
        $user_ids = DB::table('student_teacher')
            ->join('people','student_teacher.student_user_id', '=','people.user_id')
            ->join('school_user', function($join) {
                $join->on('student_teacher.student_user_id', '=', 'school_user.user_id')
                    ->where('school_user.school_id', '=', Userconfig::getValue('school_id', $this->user_id));
                })
            ->join('students', function($join) use ($operator, $value) {
                $join->on('student_teacher.student_user_id', '=', 'students.user_id')
                    ->where('students.classof', $operator, $value);
            })
            ->where('student_teacher.teacher_user_id', '=', auth()->id())
               ->where(function($query) use($search){
                   $query->where('people.last', 'LIKE', '%'.$search.'%')
                       ->orWhere('people.first', 'LIKE', '%'.$search.'%')
                       ->orWhere('people.middle', 'LIKE', '%'.$search.'%');
            })
            //->limit(1)
            ->pluck('student_teacher.student_user_id');

        foreach(Student::with([
                    'person', 'person.user','shirtsize', 'nonsubscriberemails','nonsubscriberemails.emailtype','phones','phones.phonetype'
                ])
                ->findMany($user_ids) AS $s){
            $s->student_user_id = $s->user_id;
            $s->teacher_user_id = auth()->id();
            $s->school_id = $school_id;

            $a[] = [
                'sortorder' => $s->person->fullNameAlpha,
                'obj' => $s
                ];
        }

        sort($a);

        return collect(array_column($a,'obj'));
    }

    public function tenureYearsAtSchool($school_id)
    {
        $years = 0;

        foreach($this->person->user->tenures->where('school_id', $school_id) AS $tenure){

            $years += ((($tenure->endyear) ?: date('Y')) - $tenure->startyear);
        }

        return $years;
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private function GradetypeAdd(School $school, int $gradetype_id)
    {
        if(! $this->hasGradetype($school, $gradetype_id)){

            DB::table('gradetype_school_user')
                ->insert([
                    'gradetype_id' => $gradetype_id,
                    'school_id' => $school->id,
                    'user_id' => auth()->id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        }
    }

    private function GradetypeRemove(School $school, int $gradetype_id)
    {
        if($this->hasGradetype($school, $gradetype_id)){

            DB::table('gradetype_school_user')
                ->where('gradetype_id', '=', $gradetype_id)
                ->where('school_id', '=', $school->id)
                ->where('user_id', '=', auth()->id())
                ->delete();
        }
    }
}
