<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div>

                <x-livewire-table-with-modal-forms>

                    <x-slot name="title">
                        {{ __($eventversion->name.' Application for: '.$registrant->student->person->fullName) }}
                    </x-slot>

                    <x-slot name="description">

                        <x-sidebar-blurb
                            blurb="{{ $registrant->student->person->fullName }} application for {{ $eventversion->name }}"/>

                        <x-sidebar-blurb blurb="Application.."/>

                    </x-slot>

                    <x-slot name="table">

                        {{-- ACTION LINKS --}}
                        <div class="flex justify-between">
                            {{-- BACK TO REGISTRANT PAGE --}}
                            <div class="flex text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 20 20"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                @if(config('app.url') === 'http://localhost')
                                    <a href="{{ route('registrant.show',['registrant' => $registrant]) }}"
                                       class="text-red-700 ml-2 pb-4">
                                        Return to Registrant Edit
                                    </a>
                                @else
                                    <a href="https://thedirectorsroom.com/registrant/{{ $registrant->id }}"
                                       class="text-red-700 ml-2 pb-4">
                                        Return to Registrant Edit
                                    </a>
                                @endif
                            </div>

                            {{-- BUTTON TO DOWNLOAD PDF --}}
                            {{-- HIDE DOWNLOAD BUTTON
                            <div class="bg-blue-400 text-xs pt-3 border rounded-2xl text-white px-2">
                                @if(config('app.url') === 'http://localhost')
                                    <a href="{{ route('registrant.application.download', ['registrant' => $registrant]) }}">
                                        Download Application For Review
                                    </a>
                                @else
                                    <a href="https://thedirectorsroom.com/registrant/{{ $registrant->id }}/download">
                                        Download Application For Review
                                    </a>
                                @endif
                            </div>
                            --}}
                        </div>

                        <style>
                            .sectionheader{background-color: lightgray; padding-left: .5rem; font-weight: bold;}
                        </style>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="flex text-xl my-4" >

                                        <div class="justify-self-center w-full">
                                            <div class="font-bold text-center">All-Shore Chorus</div>
                                            <div class="text-center">{{ $eventversion->name }}</div>
                                            <div class="text-center text-sm">
                                                Student Audition eApplication
                                            </div>
                                        </div>

                                    </div>

                                    {{-- STUDENT DETAIL DECLARATION --}}
                                    <div class="mb-4">
                                        <style>
                                            .detail-row{display:flex; width: 90%;}
                                            .detail-row label{width: 25%;}
                                            .detail-row .data{font-weight: bold; margin-left: .5rem;}
                                            .list{background-color: lightgray; padding: 1rem .5rem;}
                                            .list ol{margin-left: 1rem; list-style-type: decimal;}
                                        </style>
                                        <div class="detail-row">
                                            <label>Emails:</label>
                                            <div class="data">{{ $registrant->student->emailsCsv }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Student Name:</label>
                                            <div class="data">{{ $registrant->student->person->fullName }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>School:</label>
                                            <div class="data">{{ $registrant->student->currentSchoolname }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Teacher:</label>
                                            <div class="data">{{ $registrant->student->currentTeachername }}</div>
                                        </div>

                                        <div class="detail-row">
                                            <label>Voice Part:</label>
                                            <div class="data">{{ $registrant->instrumentations->first()->formattedDescr() }}</div>
                                        </div>
                                    </div>

                                    @if(config('app.url') === 'http://localhost')
                                        <form method="post" action="{{ route('registrant.eapplication', ['registrant' => $registrant]) }}">
                                    @else
                                        <form method="post" action="https://thedirectorsroom.com/registrant/{{ $registrant->id }}/eapplication">
                                            @endif

                                            @csrf

                                    <style>
                                        .descr a{color:blue;}
                                        .descr a:hover{text-decoration: underline;}
                                        .addendum{font-style: italic;}
                                    </style>

                                    {{-- ELIGIBILITY --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Eligibility Requirements
                                        </div>
                                        <div class="descr">
                                            <a href="https://www.allshorechorusnj.com/auditions">
                                                Please read through the 2022 New Jersey All-Shore Chorus Eligibility Requirements by clicking here!
                                            </a>
                                        </div>
                                        <div class="confirmation">
                                            <input type="checkbox" name="eligibility" id="eligibility" value="1"
                                                {{ $eapplication && $eapplication->eligibility == 1 ? 'CHECKED' : ''  }}
                                            />
                                            <label>I have read them.</label>
                                        </div>
                                    </div>

                                    {{-- STUDENT RULES AND REGULATIONS --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Student Rules and Regulations
                                        </div>
                                        <div class="descr">
                                            <a href="https://www.allshorechorusnj.com/auditions">
                                                Please read through the 2022 New Jersey All-Shore Chorus Rules and Regulations by clicking here!
                                            </a>
                                        </div>
                                        <div class="confirmation">
                                            <input type="checkbox" name="rulesandregs" id="rulesandregs" value="1"
                                                {{ $eapplication && $eapplication->rulesandregs == 1 ? 'CHECKED' : ''  }}
                                            />
                                            <label>I have read them carefully.</label>
                                        </div>
                                    </div>

                                    {{-- USE OF IMAGE --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Use of your image
                                        </div>
                                        <div class="descr">
                                                I understand that my photograph may be taken during rehearsal or
                                                performance, and possibly posted on the {{ $eventversion->name }}
                                                social media accounts.
                                        </div>
                                        <div class="confirmation">
                                            <input type="checkbox" name="imageuse" id="imageuse" value="1"
                                                {{ $eapplication && $eapplication->imageuse == 1 ? 'CHECKED' : ''  }}
                                            />
                                            <label>I understand and agree.</label>
                                        </div>
                                    </div>

                                    {{-- ABSENCES --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Absences
                                        </div>
                                        <div class="descr">
                                            While reading these documents, I took note of the fact that all members
                                            are allowed two absences.  If a student is absent a third time, they are
                                            automatically dismissed from the chorus.
                                        </div>
                                        <div class="addendum">
                                            There is one exception.  If a student in 12th grade can provide documentation
                                            of a music college audition, a third absense will be allowed upon review
                                            of the {{ $eventversion->name }} committee.
                                        </div>
                                        <div class="confirmation">
                                            <input type="checkbox" name="absences" id="absences" value="1"
                                                {{ $eapplication && $eapplication->absences == 1 ? 'CHECKED' : ''  }}
                                            />
                                            <label>I understand and agree.</label>
                                        </div>
                                    </div>


                                    {{-- LATES --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Lates
                                        </div>
                                        <div class="descr">
                                            I took note of the fact that any three "lates" to a rehearsal will count as
                                            one absence.
                                        </div>
                                        <div class="addendum">
                                            And yes, one minute late is considered late.
                                        </div>
                                        <div class="confirmation">
                                            <input type="checkbox" name="lates" id="lates" value="1"
                                                {{ $eapplication && $eapplication->lates == 1 ? 'CHECKED' : ''  }}
                                            />
                                            <label>I understand and agree.</label>
                                        </div>
                                    </div>

                                    {{-- ELIGIBILITY REQUIREMENTS --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Eligibility Requirements
                                        </div>
                                        <div class="list">
                                            <ol>
                                                <li>
                                                    Any school in Monmouth or Ocean Country with students in grades 9,10,11, or 12
                                                    may participate in the All-Shore Chorus.
                                                </li>
                                                <li>
                                                    Each member school (that is, each school which separately pays a
                                                    membership fee) may send a total of up to 25 students to auditions.
                                                    If several schools share a membership (such as a junior and senior
                                                    high school) the number of students sent from all of the schools
                                                    combined may total up to 25 students.  Schools sending more than
                                                    25 students to auditions will have all of their students disqualified.
                                                </li>
                                                <li>
                                                    All students from a school whose Choral Director does not submit
                                                    the proper membership forms and audition registration on time are
                                                    ineligible to participate in the All-Shore Chorus and will not be
                                                    permitted to audition.
                                                </li>
                                                <li>
                                                    All Students from any school are automatically ineligible to participate
                                                    in All-Shore Chorus is a qualified judge from the school is not
                                                    present for the entire day of auditions.  This is normally the Director
                                                    of the school chorus.  Directors who can be present for only part of
                                                    the evening must arrange for a substitute for the remainder of the
                                                    evening.  Each member school must be represented by a separate judge.
                                                    No exceptions will be made.
                                                </li>
                                                <li>
                                                    All Students must complete a Student Audition Form.  In incomplete,
                                                    the student will not be allowed to audition.
                                                </li>
                                                <li>
                                                    All students auditioning for the All-Shore Chorus must be regular
                                                    members of the choir/chorus of their own school.  Only students who
                                                    are well qualified, well prepared, of good character, and of a
                                                    reliable nature should be permitted to audition.  Each student who
                                                    sings in the All-Shore Chorus is required to sign a membership
                                                    agreement regarding the responsibilities of membership in the chorus.
                                                    This must also be signed by their parent/guardian, school principal,
                                                    and Choral Director.
                                                </li>
                                                <li>
                                                    An auditioning student may attend either a junior or senior high
                                                    school, and she/he must be in grades 9-12.  The student may audition
                                                    for any one voice part.  She/he will not be re-auditioned for
                                                    another part.  This is no restriction against male altos or female
                                                    tenors.
                                                </li>
                                                <li>
                                                    Any student will be disqualified who sings or makes noises in the hallways
                                                    during auditions.  Students must not wear any school jackets, T-shirts,
                                                    uniforms, etc., that would identify them as members of All-State,
                                                    All-Shore, Band, Chorus, Orchestra, etc., or as the recipient of any
                                                    special musical honor or award.
                                                </li>
                                                <li>
                                                    Schedule preference will be given schools whos audition information
                                                    are received first.  Once an audition time is assigned, students will
                                                    be required to audition at the designated time.
                                                </li>
                                                <li>
                                                    Students from the same school must register together and on time.
                                                    Exceptions may be made if arrangements are made with the Auditions Manager
                                                    in advance.  ONce auditions have been closed, they will no be re-opened
                                                    for late-comers.
                                                </li>
                                                <li>
                                                    Results of the auditions will be emailed to the schools as soon as
                                                    computations are completed.  The Choral Director will receive the
                                                    audition forms and score sheets for each student who auditioned.
                                                </li>
                                                <li>
                                                    A complete schodule of rehearsal dates is posted on the All-Shore
                                                    Chorus web site.
                                                </li>
                                                <li>
                                                    Each Choral Director who has any students accepted into All-Shore
                                                    Chorus MUST assist at one rehearsal minimum or his/her students
                                                    will not be permitted to audition the following year.
                                                </li>
                                            </ol>
                                        </div>
                                    </div>

                                    {{-- AUDITION PROCEDURES AND INSTRUCTIONS --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Audition Procedures and Instructions
                                        </div>
                                        <div class="descr">
                                            Please see: <a href="https://www.allshorechorusnj.com/copy-of-learning-materials">
                                                https://www.allshorechorusnj.com/copy-of-learning-materials
                                            </a>
                                        </div>
                                        <div class="descr">
                                            Please see: <a href="https://www.allshorechorusnj.com/auditions">
                                                https://www.allshorechorusnj.com/auditions
                                            </a>
                                        </div>
                                    </div>

                                    {{-- SIGNATURES --}}
                                    <div class="w-4/12 mx-auto">

                                        <div class="input-group">
                                            <input type="checkbox" name="signaturestudent" value="1"
                                                {{ $eapplication && $eapplication->signaturestudent == 1 ? 'CHECKED' : ''  }}
                                            />
                                            <label for="student">{{ $registrant->student->person->fullName }} Signature</label>
                                        </div>

                                        <div class="input-group">
                                            <input type="checkbox" name="signatureguardian" value="1"
                                                {{ $eapplication && $eapplication->signatureguardian == 1 ? 'CHECKED' : ''  }}
                                            />
                                            <label for="student">Parent/Guardian Signature</label>
                                        </div>

                                        <div class="input-group mt-8">

                                            <input type="submit" name="submit" value="Submit"
                                                   style="background-color: black; color: white; border-radius: .5rem;  padding:.25rem .5rem;"
                                            />
                                        </div>
                                        </form>


                                </div>
                            </div>
                        </div>


                    </x-slot>

                    <x-slot name="actions">

                    </x-slot>

                </x-livewire-table-with-modal-forms>
            </div>
        </div>
    </div>

</x-app-layout>


