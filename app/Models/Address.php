<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use Encryptable,HasFactory;

    protected $encryptable = ['address01','address02','city','postalcode'];

    protected $fillable = ['user_id', 'address01','address02','city','geostate_id','postalcode'];

    protected $primaryKey = 'user_id';

    /**
     * Return address in comma-separated-value format: Address01, Address02, City, State, Postalcode
     * @return string
     */
    public function getAddressCsvAttribute() : string
    {
        $str = (strlen($this->address01)) ? $this->address01 : '';

        $str .= (strlen($this->address02)) ? ', '.$this->address02 : '';

        $str .= (strlen($this->city)) ? ', '.$this->city : '';

        $str .= (strlen($this->geostate_id)) ? ', '.Geostate::find($this->geostate_id)->abbr : '';

        $str .= (strlen($this->postalcode)) ? ', '.$this->postalcode : '';

        return $str;

    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function resolveNullAddressFields($user_id)
    {
        $address = $this->where('user_id', $user_id)->first();

        if($user_id && is_null($address)){
            Address::create([
                'user_id' => $user_id,
                'address01' => '',
                'address02' => '',
                'city' => '',
                'geostate_id' => 37,
                'postalcode' => '',
            ]);
        }
    }

}
