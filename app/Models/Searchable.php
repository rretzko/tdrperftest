<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Searchable extends Model
{
    use HasFactory;

    private $hashed = '';
    private $searchable;
    private $searchtype = NULL;

    protected $fillable = ['hash'];

    /**
     * determine if $descr is a unique setting
     * if unique, confirm that row must be updated, inserted or bypassed
     * else updateOrCreate row
     *
     * @param $user
     * @param $descr
     * @param $raw
     */
    public function add(User $user, $descr, $raw)
    {//echo $descr.'<br />';
        $this->searchtype = Searchtype::where('descr', $descr)->first();
//echo($descr.': '.$this->searchtype.'<br />');
        //transform $raw values into lowercase for consistency
        $lc_raw = strtolower($raw);
        $this->hashed = $lc_raw; //hash_hmac('sha256', $lc_raw, config('hashing.hashkey'));
        $this->searchable = Searchable::firstOrCreate(['hash' => $this->hashed]);

        $this->user = $user;

        //ex. 'name' is a unique searchtype but 'phone*' is NOT unique
        ($this->searchtype->unique) ? $this->handleUnique() : $this->handleMultiple();
    }

    /**
     * NOTE: This removes the pivot table (searchable_user) row
     * and does NOT remove the searchable value
     * i.e. detaches without deleting original value
     *
     * @param User $user
     * @param string $descr //ex.email_work
     */
    public function remove(User $user, $descr)
    {
        $this->searchtype = Searchtype::where('descr', $descr)->first();

        $this->user = $user;
        $this->deleteSearchableUserRow();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot('searchtype_id');
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    /**
     * Couldn't figure out how to do this with detach
     *
     */
    private function deleteSearchableUserRow()
    {
        //$this->searchable may/may not be instantiated
        //$operand = ($this->searchable) ? '=' : '>';
        //$searchable_id = ($this->searchable) ? $this->searchable->id : 0;

        if(DB::table('searchable_user') //record exists
            ->select('user_id')
            ->where('user_id', '=', $this->user->id)
            ->where('searchtype_id', '=', $this->searchtype->id)
            ->value('user_id') ?? 0)
        {
            DB::table('searchable_user') //delete record
                ->where('user_id', '=', $this->user->id)
                ->where('searchtype_id', '=', $this->searchtype->id)
                ->delete();
        }

    }

    /**
     * Do nothing if current input matches database row,
     * else updateOrCreate
     */
    private function handleMultiple()
    {
        $current = DB::table('searchable_user')
            ->select('searchable_id')
            ->where('user_id', '=', $this->user->id)
            ->where('searchtype_id', '=', $this->searchtype->id)
            ->value('searchable_id')
            ?? 0;

        if((! $current) || ($current !== $this->searchable->id)){

            if( ! $current){ //no current value
                DB::table('searchable_user')
                    ->insert([
                        'searchable_id' => $this->searchable->id,
                        'user_id' => $this->user->id,
                        'searchtype_id' => $this->searchtype->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
            }elseif($current !== $this->searchable_id){ //different current value
                DB::table('searchable_user')
                    ->update(
                        [
                            'searchable_id' => $this->searchable->id
                        ],
                        [
                            'user_id' => $this->user->id,
                            'searchtype_id' => $this->searchtype->id,
                            'updated_at' => now(),
                        ],
                    );
            }else{ //same current value

                $fresh = $current;
            }
        }
    }

    /**
     * @todo this may be better handled with ->toggle()
     * Do nothing if current input matches database row,
     * else updateOrCreate
     */
    private function handleUnique()
    {
        //remove the current row
        $this->deleteSearchableUserRow();
//info($this->searchtype->id);
        //attach new row
        $this->searchable->users()->attach($this->user->id, ['searchtype_id' => $this->searchtype->id]);
    }
}
