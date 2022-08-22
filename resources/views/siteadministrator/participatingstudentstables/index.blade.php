<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->
<div style="display: none;">{{ set_time_limit(180) }}</div>
    <div class="bg-white p-4 mx-4">
        <header>
            {{ $eventversion->name }}
        </header>

        <style>
            table{background-color: white; border-collapse: collapse; text-align: center;}
            td,th{border: 1px solid black; padding:0 .25rem;}
        </style>
        @foreach($participating AS $key => $participants)
            <h3>{{ $key }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>###</th>
                        <th>Reg.Id</th>
                        <th>Name</th>
                        <th>Grade</th>
                        <th>Voice</th>
                        <th>Score</th>
                        <th>School</th>
                        <th>Teacher</th>
                        <th>Student Personal</th>
                        <th>Student School</th>
                        <th>Student Mobile</th>
                        <th>Student Home</th>
                        <th>Teacher Email Work</th>
                        <th>Teacher Email Personal</th>
                        <th>Teacher Email Other</th>
                        <th>Teacher Phone Mobile</th>
                        <th>Teacher Phone Work</th>
                        <th>Teacher Phone Home</th>
                        <th>Parent/Guardian</th>
                        <th>Parent/Guardian Email Primary</th>
                        <th>Parent/Guardian Email Alternate</th>
                        <th>Parent/Guardian Mobile</th>
                        <th>Parent/Guardian Work</th>
                        <th>Parent/Guardian Home</th>
                        <th>Height</th>
                        <th>Shirt Size</th>
                        <th>Pronouns</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($participants AS $registrant)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $registrant->id }}</td>
                            <td style="text-align: left;">{{ $registrant->student->person->fullnameAlpha }}</td>
                            <td>{{ $registrant->student->grade }}</td>
                            <td>{{ strtoupper($registrant->instrumentations()->first()->abbr) }}</td>
                            <td>{{ $scoresummary->registrantScore($registrant) }}</td>
                            <td style="text-align: left;">
                                {{ $registrant->student->currentSchoolAllUsers->shortName }}
                            </td>
                            <td style="text-align: left;">
                                {{ $registrant->student['teachers']->first()->person->fullname ?? 'None Found' }}
                            </td>
                            <td style="text-align: left">
                                {{ $registrant->student->emailPersonal->id ? $registrant->student->emailPersonal->email : '' }}
                            </td>
                            <td style="text-align: left">
                                {{ $registrant->student->emailSchool->id ? $registrant->student->emailSchool->email : '' }}
                            </td>
                            <td>
                                {{ $registrant->student->phoneMobile->id ? $registrant->student->phoneMobile->phone : '' }}
                            </td>
                            <td>
                                {{ $registrant->student->phoneHome->id ? $registrant->student->phoneHome->phone : '' }}
                            </td>
                            <td>
                                {{ $registrant->student['teachers']->first() ? $registrant->student['teachers']->first()->person->subscriberemailwork : '' }}
                            </td>
                            <td>
                                {{ $registrant->student['teachers']->first() ? $registrant->student['teachers']->first()->person->subscriberemailpersonal : '' }}
                            </td>
                            <td>
                                {{ $registrant->student['teachers']->first() ? $registrant->student['teachers']->first()->person->subscriberemailother : '' }}
                            </td>
                            <td>
                                @if($registrant->student['teachers']->first())
                                    {{$registrant->student['teachers']->first()->person->phoneMobile() }}
                                @endif
                            </td>
                            <td>
                                @if($registrant->student['teachers']->first())
                                    {{$registrant->student['teachers']->first()->person->phoneWork() }}
                                @endif
                            </td>
                            <td>
                                @if($registrant->student['teachers']->first())
                                    {{$registrant->student['teachers']->first()->person->phoneHome() }}
                                @endif
                            </td>
                            <td>
                                @if($registrant->student->guardians->first())
                                    {{ $registrant->student->guardians->first()->person->fullName }}
                                @endif
                            </td>
                            <td>
                                @if($registrant->student->guardians->first())
                                    {{ $registrant->student->guardians->first()->emailPrimary->email }}
                                @endif
                            </td>
                            <td>
                                @if($registrant->student->guardians->first())
                                    {{ $registrant->student->guardians->first()->emailAlternate->email }}
                                @endif
                            </td>
                            <td>
                                @if($registrant->student->guardians->first())
                                    @if($registrant->student->guardians->first()->phoneMobile->id)
                                        {{ $registrant->student->guardians->first()->phoneMobile->phone }}
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($registrant->student->guardians->first())
                                    @if($registrant->student->guardians->first()->phoneWork->id)
                                        {{ $registrant->student->guardians->first()->phoneWork->phone }}
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($registrant->student->guardians->first())
                                    @if($registrant->student->guardians->first()->phoneHome->id)
                                        {{ $registrant->student->guardians->first()->phoneHome->phone }}
                                    @endif
                                @endif
                            </td>
                            <td>{{ $registrant->student->height }}</td>
                            <td>{{ $registrant->student->shirtsize->descr }}</td>
                            <td>{{ $registrant->student->person->pronoun->descr }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</x-app-layout>
