<?php

namespace App\Models\Utility;

use App\Models\Registranttype;
use App\Models\Userconfig;
use App\Traits\RegistranttypeBackgroundColorsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schoolregistrationstatus extends Model
{
    use HasFactory,RegistranttypeBackgroundColorsTrait;

    public static function horizontalBarChart()
    {
        $counts = [];

        $counts['applied'] = [self::calcStatus(Registranttype::APPLIED),Registranttype::APPLIED];
        $counts['eligible'] = [self::calcStatus(Registranttype::ELIGIBLE),Registranttype::ELIGIBLE];
        $counts['prohibited'] = [self::calcStatus(Registranttype::PROHIBITED),Registranttype::PROHIBITED];
        $counts['registered'] = [self::calcStatus(Registranttype::REGISTERED),Registranttype::REGISTERED];
        $total = array_sum(array_column($counts, 0));



        $str =  '<div class="flex bg-gray-200 w-full">';

            $str .= '<label class="w-3/12 pl-2 pt-1 text-xs">Registration Progress: </label>';

            $str .= '<div class="flex flex-row w-9/12">';

                foreach($counts AS $key => $values){

                    if($values[0]) {

                        $pct = number_format((($values[0] / $total) * 100), 0);
                        $bgcolor = self::colors($values[1]);

                        $str .= '<div class="border border-black '.$bgcolor.' text-center"
                                    style="width: '.$pct.'%;"
                                    title="'.ucwords($key)
                            .'">';
                            $str .= $values[0];
                        $str .= '</div>';
                    }
                }

            $str .= '</div>';

        $str .= '</div>';

        return $str;
    }
/** END OF PUBLIC FUNCTIONS **************************************************/

    private static function calcStatus(int $registranttype_id) : int
    {
        return DB::table('registrants')
            ->where('eventversion_id', '=', Userconfig::getValue('eventversion', auth()->id()))
            ->where('school_id', '=', Userconfig::getValue('school', auth()->id()))
            ->where('registranttype_id', '=', $registranttype_id)
            ->count('id') ?? 0;
    }
}
