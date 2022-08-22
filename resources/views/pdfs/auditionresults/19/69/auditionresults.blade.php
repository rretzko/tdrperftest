<div style="display: none;">{{ set_time_limit(360) }}</div>
<style>
    table{border-collapse: collapse;margin:auto;}
    td,th{border: 1px solid black; text-align: center; padding:0 .25rem; font-size: .66rem;}

    .page_break{page-break-before: always;}
</style>

@foreach($registrants AS $key => $registrant)
    <div style="text-align: center; font-size: 1.5rem;">
        Audition Results for the {{ $eventversion->name }}
    </div>
    
    <h3>{{ $registrant->student->person->fullName.': '.$registrant->instrumentations->first()->formattedDescr() }}</h3>

    <table>
        <thead>
            <tr>
                <th colspan="3" style="border-top: 0; border-left: 0;"></th>
                @for($i = 1; $i<=$eventversion->eventversionconfigs->judge_count; $i++)
                    <th colspan="{{ $eventversion->scoringcomponents->count() }}" style="border-right: 1px solid black;">
                        Judge #{{ $i }}
                    </th>
                @endfor
            </tr>
            <tr>
                <th colspan="3" style="border-top: 0; border-left: 0;"></th>
                @for($i = 1; $i<=$eventversion->eventversionconfigs->judge_count; $i++)
                    @foreach($eventversion->filecontenttypes AS $filecontenttype)
                        <th colspan="{{ $filecontenttype->scoringcomponents->where('eventversion_id', $eventversion->id)->count() }}">
                            {{ ucwords(substr($filecontenttype->descr,0,5)) }}
                        </th>
                    @endforeach
                @endfor
                <th colspan="3" style="border-top:0; border-right: 0;"></th>
            </tr>
            <tr>
                <th>###</th>
                <th>Reg.Id</th>
                <th>Voice</th>
                @for($i = 1; $i<=$eventversion->eventversionconfigs->judge_count; $i++)
                    @foreach($eventversion->scoringcomponents AS $scoringcomponent)
                        <th>{{ $scoringcomponent->abbr }}</th>
                    @endforeach
                @endfor
                <th>Total</th>
                <th>Mix</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $registrant->id }}</td>
                <td>{{ strtoupper($registrant->instrumentations->first()->abbr)  }}</td>

                @foreach($score->registrantScores($registrant) AS $value)
                    <td>{{ $value }}</td>
                @endforeach

                <td>
                    {{ $scoresummary->registrantScore($registrant) }}
                </td>
                <td>
                    {{ $scoresummary->registrantResult($registrant) }}
                </td>
            </tr>

        </tbody>
    </table>

    {{-- PAGE BREAK --}}
    <div class="page_break"></div>

@endforeach


