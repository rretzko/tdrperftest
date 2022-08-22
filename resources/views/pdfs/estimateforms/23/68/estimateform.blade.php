<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table {
            border-collapse: collapse;
            margin: auto;
            margin-bottom: 1rem;
            width: 96%;
        }
        #roster td,th{
            border: 1px solid black;
        }
    </style>
    <title></title>
</head>
<body style="border: 1px solid white; padding: 1rem; ">
<table>
    <tr>
        <td style="max-width: 40%; vertical-align: top; font-size: .8rem;" >
            <div style="text-align: center; font-weight: bold;">
                STUDENT ESTIMATE FORM
            </div>
            <div style="text-align: center;">
                {{ $eventversion->name }}
            </div>

            <div style="border: 1px solid black; padding: .25rem; margin-bottom: 0.5rem;">
                No changes will be allowed after the <b>December 10, 2021</b>.
            </div>

            <div>
                <div class="text-center data">Director's Information</div>
                <div class="input-group">
                    <label for="">Name:</label>
                    <span class="data">{{ auth()->user()->person->fullName }}</span>
                </div>
                <div class="input-group">
                    <label for="">School:</label>
                    <span class="data">{{ $school->name }}</span>
                </div>
                <div class="input-group">
                    <label for="">School Address:</label>
                    <span class="data">{{ $school->mailingAddress }}</span>
                </div>
                <div class="input-group">
                    <style>ul{margin: 0;list-style-type: none;}</style>
                    <label for="">Director email:</label>
                    <span class="data">{!! auth()->user()->person->subscriberemailsStacked !!}</span>
                </div>
                <div class="input-group">
                    <label for="">Director Phone(s):</label>
                    <span class="data">{{ auth()->user()->person->subscriberPhoneCsv }}</span>
                </div>
                <div class="input-group">
                    <label for="">Other schools travelling with you:</label>
                    <span class="data">_____________________________________</span>
                </div>
            </div>
            <div>
                <div><b><u>TEACHER PLEDGE</u></b></div>
                <div>
                    I agree to assist the managers at the
                    necessary rehearsals and/or concerts if I have any students accepted into the
                    chorus.  I further certify that I am a member of <i>NAfME</i> and have attached a copy
                    of my current <i>NAfME</i> card.  I have thoroughly read, understand and agree to all of
                    the information contained in this bulletin.
                </div>
                <div>
                    Choral Director's Signature __________________________________________  Date ______
                </div>
                <div>
                    <b><u>Please attach a copy of the back of your <i>NAfME</i> card to this page!</u></b>
                </div>
                <div>
                    A limited number of music packets will be available for teachers to purchase.<br />
                    _____ I would like to purchase a music packet and have included an extra $15 in my
                    check.  (Your $15 will be refunded if you do not have a student in the chorus or if
                    there are no remaining packets.)
                </div>
            </div>
        </td>
        <td style="width: 60%; vertical-align: top;">


            <table id="roster" style=" vertical-align: top;">
                <tr style="border: 1px solid black; padding: .25rem;background-color: rgba(0,0,0,.1);">
                    <th colspan="5" style="text-align: center; font-size: .8rem;">
                        A mandatory $25 fee is added for the Director's Packet.
                    </th>
                </tr>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Voice Part</th>
                    <th>Grade</th>
                    <th>Fee</th>
                </tr>
                </thead>
                <tbody>

                @for($i=0;$i<$eventversion->eventversionconfigs->max_count;$i++)
                    @if(isset($registrants[$i]))
                        <tr>
                            <td style="text-align: center;">{{ ($i + 1) }}</td>
                            <td style="text-align: left;padding-left: .25rem;">{{ $registrants[$i]->student->person->fullNameAlpha }}</td>
                            <td style="text-align: center;">{{ $registrants[$i]->instrumentations->first()->descr }}</td>
                            <td style="text-align: center;">{{ $registrants[$i]->student->grade }}</td>
                            <td style="text-align: center;">${{ $eventversion->eventversionconfigs->registrationfee * ($i + 1) }}</td>
                        </tr>
                    @else
                        <tr>
                            <td style="text-align: center;">{{ ($i + 1) }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: center;">${{ $eventversion->eventversionconfigs->registrationfee * ($i + 1) }}</td>
                        </tr>
                    @endif

                @endfor

                </tbody>
            </table>

            <table>
                <thead>
                <tr>
                    <td></td>
                    @foreach($eventversion->instrumentations() AS $instrumentation)
                        <th >{{ strtoupper($instrumentation->abbr) }}</th>
                    @endforeach
                    <th>Total Enclosed<br />(incl. Director's Packet)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Voice Part Totals</th>
                    @foreach($eventversion->instrumentations() AS $instrumentation)
                        <th class="{{ (! $registrantsbyinstrumentation[$instrumentation->id]) ? 'text-gray-300' : '' }}">
                            {{ $registrantsbyinstrumentation[$instrumentation->id] }}
                        </th>
                    @endforeach
                    <th style="text-align: center;">${{ ($amountduenet + 25) }}</th>
                </tr>
                </tbody>
            </table>

        </td>
    </tr>

</table>
</body>
</html>
