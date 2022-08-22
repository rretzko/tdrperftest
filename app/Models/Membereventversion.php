<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Return eventversions where auth()->id()
 *  - Belongs to Organization
 *  - Organization has Events
 *  - Events have Eventversions
 *  - Eventversions are open
 *  - auth()->id() belongs to a role which is open for the Eventversion
 *
 */

class Membereventversion extends Model
{
    private static $eventversions;

    public static function open()
    {
        self::init();

        return self::$eventversions;
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private static function init()
    {
        self::filterForMembership();

        self::filterForAdmin();
    }

    /**
     * @todo group by Event and then eventversion in descending order
     */
    private static function filterForMembership()
    {
        //identify organization_id to which auth()->id() belongs
        $organizations = Membership::where('user_id', auth()->id())->pluck('organization_id')->toArray();

        //identify eventversions with open or admin status
        self::$eventversions = Eventversion::with('event', 'event.organization')
            ->where('eventversiontype_id', Eventversiontype::OPEN)
            ->orWhere('eventversiontype_id', Eventversiontype::ADMIN)
            ->orderByDesc('id')
            ->get()
            //filter-out those open/admin eventversions to which auth()->id() does NOT belong
            ->filter(function( $eventversion) use ($organizations){
                return in_array($eventversion['event']['organization']->id, $organizations);
            });

    }

    private static function filterForAdmin()
    {
        self::$eventversions = self::$eventversions->filter(function($eventversion) {

            //early exit
            if($eventversion->eventversiontype_id !== Eventversiontype::ADMIN){
                return true;
            }

            return Membership::where('user_id', auth()->id())
                ->where('organization_id', $eventversion['event']['organization']->id)
                ->first()
                ->roletypeIsAdmin;
        });
    }
}
