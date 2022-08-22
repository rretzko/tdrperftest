@props([
'person'
])
<style>
    label{margin-right: 1rem;}
    .card-row{display: flex;}
    .data{font-weight: bold;}
</style>
<div class="flex flex-col border border-black mb-2 p-1">
    <div class="card-row">
        <label>Sys.Id.</label>
        <div class="data">{{ $person->user_id }}</div>
    </div>

    <div class="card-row">
        <label>Username</label>
        <div class="data">{{ $person->user->username }}</div>
    </div>

    <div class="card-row">
        <label>Name</label>
        <div class="data">{{ $person->fullName }}</div >
    </div>

    <div class="card-row">
        <label>Status</label>
        <div class="data">
            @if($person->user->isTeacher())Teacher
            @elseif($person->user->isStudent())Student
            @else
                Other
            @endif
        </div>
    </div>

    <div>
        @if($person->user->isTeacher())
            <div class="card-row">
                <label>Email personal</label>
                <div class="data">
                    {{ strlen($person->emailPersonal) ? $person->emailPersonal :  ''}}
                </div>
            </div>

            <div class="card-row">
                <label>Email work</label>
                <div class="data">
                    {{ strlen($person->emailWork) ? $person->emailWork :  ''}}
                </div>
            </div>

            <div class="card-row">
                <label>Email other</label>
                <div class="data">
                    {{ strlen($person->emailOther) ? $person->emailOther : ''}}
                </div>
            </div>
        @endif
    </div>

    <div>
        @if($person->user->isStudent())
            <div class="card-row">
                <label>Email student personal</label>
                <div class="data">
                    @if($person->student->emailPersonal->id)
                        {{ $person->student->emailPersonal->email}}
                    @endif
                </div>
            </div>

            <div class="card-row">
                <label>Email student school</label>
                <div class="data">
                    @if($person->student->emailSchool->id)
                        {{ $person->student->emailSchool->email }}
                    @endif
                </div>
            </div>

            <div class="card-row">
                <label>Current Teacher</label>
                <div class="data">
                    {{ $person->student->sysAdminCurrentTeachername }}
                </div>
            </div>

        @endif
    </div>

    <div>
        <div class="card-row">
            <label>Schools</label>
            <div class="data">
                @if($person->user->schools->count())
                    <ul>
                    @foreach($person->user->schools AS $school)
                        <li>{{ $school->name.' ('.$school->id.')' }}</li>
                    @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div>
        <div class="card-row">
            <label>CJMEA RegId</label>
            <div class="data">
                @if($person->user->isStudent())
                {{ $person->student->registrants->last() ? $person->student->registrants->last()->id : 0}}
                @endif
            </div>
        </div>
    </div>






</div>
