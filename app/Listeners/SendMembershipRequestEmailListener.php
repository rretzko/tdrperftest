<?php

namespace App\Listeners;

use App\Events\MembershipRequestEvent;
use App\Mail\MembershipRequestMail;
use App\Models\Membership;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMembershipRequestEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MembershipRequestEvent  $event
     * @return void
     */
    public function handle(MembershipRequestEvent $event)
    {
        $datatable = $this->datatable($event);
        foreach($event->organization->membershipmanagers() AS $sendto){

            foreach($sendto->subscriberEmails AS $email){

                Mail::to($email->email)->send(new MembershipRequestMail($event, $sendto, $datatable));
            }

        }

    }

    private function datatable($event)
    {
        $membership = Membership::where('user_id', auth()->id())
            ->where('organization_id', $event->organization->id)
            ->first();

        $str = '<table>';

        $str .= '<tbody>';

        $str .=
            '<tr>'
            . '<td>Name</td>'
            . '<th>' . $event->requester->fullName . '</th>'
            . '</tr>';

        $str .=
            '<tr>'
            . '<td>School(s)</td>'
            . '<th>';
        foreach ($event->requester->user->schools as $school){
            $str .= $school->name . '<br />';
        }
        $str .='</th>'
            .'</tr>';

        $str .= '<tr>'
            .'<td>Membership type</td>'
            .'<th>'.$membership->requesttypedescr.'</th>'
            .'</tr>';

        $str .= '<tr>'
            .'<td>Membership id</td>'
            .'<th>'.$membership->membership_id.'</th>'
            .'</tr>';

        $str .= '<tr>'
            .'<td>Expiration</td>'
            .'<th>'.$membership->expirationMdy().'</th>'
            .'</tr>';

        $str .= '<tr>'
            .'<td>Grade Levels</td>'
            .'<th>'.$membership->grade_levels.'</th>'
            .'</tr>';

        $str .= '<tr>'
            .'<td>Subject</td>'
            .'<th>'.$membership->subjects.'</th>'
            .'</tr>';

        $str .= '</tbody>';

        $str .= '</table>';

        return $str;
    }
}
