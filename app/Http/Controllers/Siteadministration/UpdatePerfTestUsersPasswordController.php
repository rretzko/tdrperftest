<?php

namespace App\Http\Controllers\Siteadministration;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdatePerfTestUsersPasswordController extends Controller
{
    public function index()
    {
        $this->updatePasswords();

        return back();
    }

    private function updatePasswords()
    {
        foreach($this->usernames() AS $username){

            $user = User::where('username', $username)->first();
if(is_null($user)){dd($username);}
            $user->update(
                [
                    'password' => Hash::make('password'),
                ]
            );
        }
    }

    private function usernames()
    {
        return [
            'abaldasserini',
            'afoster',
            'agigliotti',
            'agood',
            'apaynter',
            'asinigaglio',
            'asix',
            'bbacon',
            'bmoore',
            'clinnell',
            'cnappa',
            'cnevill',
            'cscire17',
            'cshields379',
            'cwilson',
            'dking',
            'dmalloy',
            'dmay',
            'dterry',
            'efretz',
            'ekneuer',
            'ethoman',
            'ewise',
            'gkehl',
            'hlockart',
            'jallen',
            'jbaccaro',
            'jdesiena',
            'jdeyoung',
            'jgreen275',
            'jkolody',
            'jlisner',
            'jmeszaros',
            'jmillar',
            'jpomeroy',
            'jweir',
            'jwilson',
            'jwilsonjwilson318',
            'jwoodworth',
            'kakinskas',
            'kbettys',
            'kbryson',
            'kdunn',
            'kmeo',
            'louspi@bergen.org',
            'lmorneweckfuld',
            'lrussoniello',
            'lvoight',
            'mdrew',
            'melkin',
            'mgaskoiv',
            'mgreen',
            'mlampert',
            'mpafumi',
            'mstingle',
            'msuozzo',
            'mswiss',
            'ncardillo',
            'ndiaz',
            'nnoa',
            'pblanchard',
            'pdanner',
            'phachey',
            'pkane',
            'pturowski',
            'rhansonswinney',
            'rvega',
            'sconners',
            'skirkland',
            'sstofakrombholz',
            'tcherney',
            'tvoorhis',
        ];
    }
}
