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
                                <a href="{{ route('registrant.show',['registrant' => $registrant]) }}"
                                   class="text-red-700 ml-2 pb-4">
                                    Return to Registrant Edit
                                </a>
                            </div>

                            {{-- BUTTON TO DOWNLOAD PDF --}}
                            {{-- Request that this be hidden: Amy Melson, 05-Oct-21 --}}
                            <!-- {{--
                            <div class="bg-blue-400 text-xs pt-3 border rounded-2xl text-white px-2">
                                <a href="{{ route('registrant.application.download', ['registrant' => $registrant]) }}">
                                    Download Application For Signing
                                </a>
                            </div>
                            --}} -->
                        </div>

                        <style>
                            .sectionheader{background-color: lightgray; padding-left: .5rem; font-weight: bold;}
                        </style>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="flex text-xl my-4" >
                                        <div class="justify-self-start">
                                            <img
                                                src="\assets\images\njmea_logo_state.jpg"
                                                alt="NJMEA logo image"
                                            />
                                        </div>
                                        <div class="justify-self-center w-full">
                                            <div class="font-bold text-center">{{ $registrant->student->currentSchoolName }}</div>
                                            <div class="text-center">NJ ALL-STATE CHORUS</div>
                                            <div class="text-center text-sm">Student Application</div>
                                        </div>
                                    </div>

                                    {{-- STUDENT DETAIL DECLARATION --}}
                                    <div class="flex justify-center font-bold mb-4">
                                        <div class="border border-black px-2" >
                                            {{ $registrant->student->person->fullName }}
                                        </div>
                                        <div class="border border-black px-2 text-red-600 uppercase" >
                                            {{ $registrant->instrumentationsCSV }}
                                        </div>
                                        <div class="border border-black px-2">
                                            Grade: {{ $registrant->student->gradeClassof }}
                                        </div>
                                        <div class="border border-black px-2">
                                            {{ $registrant->student->currentSchoolName }}
                                        </div>
                                    </div>

                                    {{-- AUDITION FEE --}}
                                    <div class="flex justify-end mb-2 font-bold" >
                                        <div class="text-xs">THE AUDITION FEE IS: ${{ number_format($eventversion->eventversionconfigs->registrationfee,2) }}</div>
                                    </div>

                                    {{-- GUARDIAN ENDORSEMENT --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            PARENT/LEGAL GUARDIAN ENDORSEMENT - SIGNATURES REQUIRED
                                        </div>
                                        <div class="italic justify-self-stretch mx-4 mb-4">
                                            As the parent or legal guardian of <b>{{ $registrant->student->person->fullName }}</b>, I declare that I have
                                            read the endorsement, which {{ $registrant->student->person->first_name }} has signed, and I give permission
                                            for {{ $registrant->student->person->pronoun->possessive }} to audition to become a member of the
                                            {{ $eventversion->name }}.  I promise to assist {{ $registrant->student->person->first_name }} in
                                            fulfilling All-State obligations and in meeting any expenses necessary for rehearsals and concerts.  I
                                            understand it is the policy of NJMEA  that if an All-State student is incapacitated in any way that
                                            requires additional assistance, it will be the responsibility of the All-State student's parent/guardian/school
                                            to provide the necessary help at all rehearsals, meals, concerts, etc.  The provided chaperone will be
                                            housed with the student and will be charged the regular student housing fee.
                                        </div>

                                        <div>
                                            <div class="flex justify-between font-bold" >
                                                <div>
                                                    PARENT/LEGAL GUARDIAN SIGNATURE: ________________________
                                                </div>
                                                <div>
                                                    DATE: _________
                                                </div>
                                            </div>
                                            <div class="font-bold">
                                                PARENT/LEGAL GUARDIAN CELL: {{ $registrant->student->guardians->first()->person->phoneMobile }}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- PRINCIPAL/TEACHER ENDORSEMENT --}}
                                    <div class="mb-4">
                                        <div class="sectionheader">
                                            PRINCIPAL/TEACHER ENDORSEMENT - SIGNATURES REQUIRED
                                        </div>
                                        <div class="italic justify-self-stretch mx-4 mb-4" >
                                            We recommend <b>{{ $registrant->student->person->fullName }}</b> for participation in the {{ $eventversion->name }}.
                                            <b>{{ $registrant->student->person->first_name }}</b> is a qualified candidate in good
                                            standing in {{ $registrant->student->person->pronoun->possessive }} Choral Department and is presently
                                            enrolled in grade {{ $registrant->student->gradeClassof }} at {{ $registrant->student->currentSchoolName }}.
                                            We understand that <b>{{ $me->first_name }}</b>, who is sponsoring <b>{{ $registrant->student->person->fullName }}</b>,
                                            is to be a current (paid) member of the National Association for Music Educators (NAfME), and is required to
                                            participate as a JUDGE FOR VIRTUAL AUDITIONS, as described in the Directors's Packet, from October 14-16, 2021.

                                            We will review this application to ensure that all parts are complete and accurate.  This application
                                            will be mailed to the audition chairperson postmarked by the application deadline of <b>October 6th, 2021</b>.
                                            LATE APPLICATIONS WILL NOT BE ACCEPTED.  If <b>{{ $registrant->student->person->fullName }}</b> is accepted,
                                            we will ensure that <b>{{ $registrant->student->person->first_name }}</b> is prepared and adheres to
                                            the rules and regulations set forth by the NJMEA.

                                        </div>

                                        <div>{{-- SIGNATURES --}}
                                            <div class="flex justify-between font-bold mb-4" >
                                                <div>
                                                    HS PRINCIPAL SIGNATURE: ________________________
                                                </div>
                                                <div>
                                                    DATE: _________
                                                </div>
                                            </div>
                                            <div style="display: flex; justify-content: space-between; font-weight: bold;  ">
                                                <div>
                                                    HS MUSIC TEACHER SIGNATURE: __________________
                                                </div>
                                                <div>
                                                    DATE: _________
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- STUDENT ENDORSEMENT --}}
                                    <div class="mb-4">
                                        <div class="sectionheader">
                                            STUDENT ENDORSEMENT - SIGNATURES REQUIRED
                                        </div>
                                        <div class="flex flex-col italic justify-self-stretch mx-4 mb-4">
                                            <b>In return for the privilege of participating in an NJMEA sponsored NJ All-State Ensemble, I agree to
                                                the following:</b>
                                            <ul class="ml-8 list-disc">
                                                <style>li{margin-bottom: .5rem;}</style>
                                                <li>
                                                    I, <b>{{ $registrant->student->person->fullName }}</b>, agree to accept the decision of the
                                                    judges and conductors as binding.  If selected, I will accept membership in the {{ $eventversion->name }}
                                                    for which I have auditioned.  I also agree to pay $80.00 as a participation fee
                                                    for music and rehearsal tracks.  I understand that membership in this organization may be
                                                    terminated by the endorsers of my application if I fail to comply with the rules set forth or if
                                                    I fail to learn my music.
                                                </li>
                                                <li>
                                                    I understand that NJ All-State Mixed Chorus members are expected to attend all rehearsals from
                                                    June through November.  All-State Treble Chorus rehearsals continue until February.  One
                                                    absence will result in testing at the following rehearsal.  An absence is defined as missing any
                                                    scheduled rehearsal or any part thereof.  I further understand that all activities involving
                                                    performance weekends, Atlantic City, the NJPAC Concert and the February NJMEA Conferences,
                                                    including registration sign-in and all rehearsals, must be attended in their entirety.  I understand
                                                    that it is not possible for me to be a member of the NJ All-State Chorus and participate in fall
                                                    activities including Conference/NJSIAA tournament games that may take place before/during the
                                                    completion of my NJ All-State obligations.  Failure to fulfill my NJ All-State obligations will
                                                    result in disqualification from any NJMEA sponsored event for the period of one year, up to and
                                                    including the applicable event.  I understand that the manager, with the approval of the NJ All-State
                                                    Choral Procedures Committee, will resolve all serious conflicts and/or questionable circumstances
                                                    not specifically covered by the above.
                                                </li>
                                                <li>
                                                    I will respect the property of others, will act professionally, and will treat all members of the
                                                    ensemble with respect.
                                                </li>
                                                <li>
                                                    I will learn all the music to the best of my ability.  <b>Chorus members agree to memorize all music.</b>
                                                </li>
                                                <li>
                                                    I will cooperate fully with managers, counselors, and all other administrative officials of the
                                                    NJ All-State Chorus and the New Jersey Music Educators Associations (NJMEA).
                                                </li>
                                                <li>
                                                    I will assume all responsibility for my music, folder, performance apparel, luggage and other
                                                    belongings at the sites of all rehearsals and concerts.
                                                </li>
                                                <li>
                                                    I will neither use nor have in my possession, at any time, alcoholic beverages, illegal drugs or
                                                    weapons of any kind.
                                                </li>
                                                <li>
                                                    I acknowledge that Mixed Chorus not also participate in any of these other NJ All-State ensembles:
                                                    Orchestra, Jazz Ensemble or Vocal Jazz Ensemble.  Treble Chorus members may not be a member of
                                                    the NJ All-State Band.
                                                </li>
                                                <li>
                                                    I understand that a total evaluation of my NJ All-State experience is used to determine any
                                                    recommendation for the Governor's Award, All-Eastern and/or National High School Ensembles.  In
                                                    addition to my placement in the NJ All-State Chorus, such factors as behavior, promptness and
                                                    preparedness for rehearsals will also be considered.  I understand the NJ All-State Administrative
                                                    personnel with the approval of the NJ All-State Choral Procedures Committee(s) will make these
                                                    recommendations.
                                                </li>
                                                <li>
                                                    I will adhere to all dates concerning fees/forms or any other deadlines requested for my participation.
                                                </li>
                                                <li>
                                                    I understand that NJ All-State Chorus members are required to comply with all obligations set
                                                    forth above.  Non-compliance with any provision contained herein shall constitute a breach of
                                                    this Agreement and shall serve as the basis of the participant's immediate termination and
                                                    exclusion from all performances.
                                                </li>
                                                <li>
                                                    I further understand that as a NJ All-State Chorus member, I must remain an active member in
                                                    good standing with the school ensemble that corresponds to my NJ All-State ensemble throughout
                                                    my entire All-State experience.
                                                </li>
                                            </ul>

                                        </div>

                                        <div>{{-- SIGNATURES --}}
                                            <div style="display: flex; justify-content: space-between; font-weight: bold; margin-bottom: 1rem;">
                                                <div>
                                                    STUDENT SIGNATURE: ________________________
                                                </div>
                                                <div>
                                                    DATE: _________
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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


