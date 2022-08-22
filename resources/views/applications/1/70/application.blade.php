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
                            <div class="bg-blue-400 text-xs pt-3 border rounded-2xl text-white px-2">
                                @if(config('app.url') === 'http://localhost')
                                    <a href="{{ route('registrant.application.download', ['registrant' => $registrant]) }}">
                                @else
                                    <a href="https://thedirectorsroom.com/registrant/{{ $registrant->id }}/download">
                                @endif
                                    Download Application For Signing
                                </a>
                            </div>
                        </div>

                        <style>
                            .sectionheader{background-color: lightgray; padding-left: .5rem; font-weight: bold;}
                        </style>
                        <div class="container " >
                            <div class="row justify-content-center">
                                <div class="col-md-8">

                                    {{-- HEADER --}}
                                    <div class="flex text-xl my-4 justify-between" >

                                        {{-- HEADER GRAPHIC--}}
                                        <div class=" justify-self-start ">
                                            <img
                                                src="\assets\images\cjmealogo.png"
                                                alt="CJMEA logo image"
                                            />
                                        </div>

                                        {{-- HEADER TEXT --}}
                                        <div class="">
                                            <div class="font-bold text-center">{{ $eventversion->short_name }}</div>
                                            <div class="font-bold text-center">Student Application</div>
                                            <div class="text-center">ENDORSEMENTS/SIGNATURES</div>
                                        </div>

                                    </div>

                                    {{-- ON-SITE APPLICATION ADVISORY --}}
                                    {{-- to do: Make this conditional to application close AND on-site registration option --}}
                                    <div style="text-align: center; border: 1px solid red; color: darkred; margin-bottom: 1rem;">
                                        ***** ON-SITE APPLICATION *****
                                    </div>

                                    {{-- ADVISORY --}}
                                    <div>
                                        <div class="text-center">
                                            ALL ENDORSEMENTS MUST BE SIGNED IN INK FOR THIS APPLICATION TO BE ACCEPTED.
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        GIVE THE SIGNED ENDORSEMENT TO YOUR TEACHER.
                                    </div>

                                    {{-- STUDENT DETAIL DECLARATION --}}
                                    <div class="flex justify-center font-bold mb-4 mt-4">
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
                                            {{ $registrant->student->currentSchool->shortName }}
                                        </div>
                                    </div>

                                    {{-- PHONES TABLE --}}
                                    <div class="flex justify-center font-bold mb-4 mt-4">
                                        <style>
                                            table{border-collapse: collapse; text-align: center;}
                                            td,th{border: 1px solid black; padding:0 .25rem;}
                                        </style>
                                        <table>
                                            <thead>
                                                <tr class="bg-gray-200">
                                                    <td>Home Phone</td>
                                                    <td>Student Cell Phone</td>
                                                    <td>Parent Phone</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <th>
                                                    @if($registrant->student->phoneHome->id)
                                                        {{ $registrant->student->phoneHome->phone }}
                                                    @else
                                                        No Home Phone
                                                    @endif
                                                </th>
                                                <th>
                                                    @if($registrant->student->phoneMobile->id)
                                                        {{ $registrant->student->phoneMobile->phone }}
                                                    @else
                                                        No Cell Phone
                                                    @endif
                                                </th>

                                                <th>
                                                    @if($registrant->student->guardians->count() &&
                                                        $registrant->student->guardians->first()->user_id &&
                                                        $registrant->student->guardians->first()->phoneMobile->id)
                                                        {{ $registrant->student->guardians->first()->phoneMobile->phone }}
                                                    @else
                                                        No Parent Phone
                                                    @endif
                                                </th>
                                            </tbody>
                                        </table>

                                    </div>

                                    {{-- STUDENT ENDORSEMENT --}}
                                    <div>
                                        <header class="upper underline font-bold mt-6">
                                            STUDENT ENDORSEMENT
                                        </header>
                                        <div class="text">
                                            I agree to accept the decision of the judges as binding and if selected I
                                            will accept membership in this organization. I understand that membership
                                            in this organization may be terminated by anyone that has endorsed this
                                            application if I fail to comply with the rules set forth, or if I fail to
                                            attend rehearsals for any reason not accepted, in advance, by the CJMEA
                                            Committee.  I understand that I must be a member of
                                            {{$registrant->student->currentSchool->shortName}}'s musical performing
                                            organization. I further understand that I must remain an active member of
                                            {{$registrant->student->currentSchool->shortName}}'s performing group, in
                                            good standing, throughout my CJMEA Region II Chorus experience.  I have read,
                                            understand and will adhere to the required attendance dates and policy.
                                        </div>

                                        <div class="signatureline flex flex-row justify-between mt-8">
                                            <div>
                                                Student Signature ______________________________________
                                            </div>
                                            <div>
                                                Date: _________________
                                            </div>
                                        </div>
                                    </div>

                                    {{-- PARENT ENDORSEMENT --}}
                                    <div>
                                        <header class="upper underline font-bold mt-6">
                                            PARENT ENDORSEMENT
                                        </header>
                                        <div class="text">
                                            <p>
                                                As a parent or legal guardian of {{$registrant->student->person->fullName}},
                                            I give permission for {{$registrant->student->person->first}} to be an
                                            applicant for this organization. I understand that neither
                                            {{$registrant->student->currentSchool->shortName}} nor CJMEA assumes
                                            responsibility for illness or accident.  I further attest to the statement
                                            signed by {{$registrant->student->person->fullName}} and will assist
                                            {{$registrant->student->person->first}} in fulfilling the obligation incurred.
                                            I will encourage and assist {{$registrant->student->person->first}} in
                                            complying with the attendance policy as set forth in this document.
                                            I also give permission to CJMEA to use {{$registrant->student->person->first}}'s
                                            photograph for publicity publication in print and online.
                                            </p>
                                            <p>
                                                I have read and acknowledged the rehearsal and concert schedule and I will make
                                            arrangements to pick up {{ $registrant->student->person->first }} on or within twenty-minutes
                                            after posted rehearsal dismissal time.
                                            </p>
                                        </div>

                                        <div class="signatureline flex flex-row justify-between mt-8">
                                            <div>
                                                Parent Signature ______________________________________
                                            </div>
                                            <div>
                                                Date: _________________
                                            </div>
                                        </div>
                                    </div>

                                    {{-- DIRECTOR/PRINCIPAL ENDORSEMENT --}}
                                    <div>
                                        <header class="upper underline font-bold mt-6">
                                            DIRECTOR/PRINCIPAL'S ENDORSEMENT
                                        </header>
                                        <div class="text">
                                            <p>
                                            We, the undersigned, recommend {{$registrant->student->person->fullName}}
                                            for participation in the CJMEA sponsored activity.
                                            {{$registrant->student->person->first}} is a qualified candidate for this
                                            activity and is presently enrolled in grade {{$registrant->student->grade}}
                                            at {{$registrant->student->currentSchool->shortName}}.  We understand, in
                                            order to audition, that {{$registrant->student->person->first}}:
                                            </p>
                                            <ol style="margin-left: 4rem; list-style-type: decimal;">
                                                <li> is a member of {{$registrant->student->currentSchool->shortName}}'s
                                                    musical performing organization.  By this we mean that a student
                                                    auditioning for chorus must be a member of the
                                                    {{$registrant->student->currentSchool->shortName}} choral program,
                                                    and a student auditioning for band or orchestra must be a member of
                                                    {{$registrant->student->currentSchool->shortName}} instrumental program.<br />
                                            OR
                                                </li>
                                                <li> does not have a corresponding school musical performing organzation
                                                    at the school or home school where they attend but that we know this
                                                    student and will attest to their ability and character.
                                                </li>
                                            </ol>
                                            <p>
                                            A CJMEA Region II Chorus member must remain an active member, in good standing,
                                            of the school performing organization throughout the CJMEA Region I Chorus
                                            experience.  We understand that {{$registrant->student->currentTeachername}}
                                            sponsoring this student is a paid member of NAfME and will be present on the
                                            day of auditions and will serve and complete the assignment given to them by
                                            the audition chairperson.  We also understand that we will review this
                                            application to be sure that all parts are completed correctly.  In the event
                                            that {{$registrant->student->person->fullName}} is accepted into the group,
                                            we will use our influence to see that {{$registrant->student->person->first}}
                                            is properly prepared and that {{$registrant->student->person->first}} adheres
                                            to the rules, regulations, and policies printed on this application and set
                                            forth by the performing groups.
                                            </p>
                                        </div>

                                        <div class="signatureline flex flex-row justify-between mt-8">
                                            <div>
                                                Director Signature ____________________________
                                            </div>
                                            <div>
                                                Principal Signature ____________________________
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ADVISORY --}}
                                    <div>
                                        <header class="upper underline font-bold mt-6">
                                            PLEASE NOTE:
                                        </header>
                                        <div class="text">
                                            <p>
                                                A student will not be excused for any types of performances other than
                                                one school performance with the corresponding type of CJMEA organization.
                                                For example: If the student is in the CJMEA Region II Chorus, the student
                                                may be excused from a CJMEA Region II Chorus rehearsal (excluding the
                                                dress rehearsal) to perform with his/her high school choir.  No one may
                                                miss the concert weekend rehearsals for any reason.
                                            </p>

                                            <p>
                                                All students who successfully audition will be charged a
                                                $20 acceptance
                                                fee which must be paid in full at or before the first rehearsal.  This
                                                fee will cover the cost involved in the purchase of music.  All fees must
                                                be paid in cash or by a School or Director's check only.  No
                                                parent/guardian checkes will be accepted.
                                            </p>
                                        </div>
                                    </div>

                                    {{-- HOME SCHOOLERS --}}
                                    <div>
                                        <header class="upper underline font-bold mt-6">
                                            ATTENTION HOME SCHOOL STUDENTS AND DIRECTORS
                                        </header>
                                        <div class="text">
                                            <p>
                                                Please read the special Home School Instructions included in the
                                                information section of the Director's Packet BEFORE you complete this form.
                                            </p>
                                        </div>
                                    </div>

                                    {{-- COVID-19 --}}
                                    <div class=" border border-4-black mt-6 p-4">
                                        <header class="upper underline font-bold ">
                                            COVID-19 ADVISORY
                                        </header>
                                        <div class="text">
                                            <p>
                                                By registering for/attending this event, I acknowledge that I fully
                                                understand the nature and extent of the risks presented by COVID-19 due
                                                to my in-person attendance at this event, including the risk that
                                                COVID-19 may lead to severe illness or death. I also understand and
                                                acknowledge that there are risks of exposure to COVID-19, whether
                                                resulting from travel through high-risk areas, the failure of other
                                                individuals to follow proper COVID-19 protocols, such as maintaining
                                                proper social distancing and proper hygiene measures, and other such
                                                risks. While I understand that CJMEA has taken reasonable steps to address
                                                the risks presented by COVID-19, I recognize that the COVID-19 protocols
                                                being utilized at the event may be insufficient to prevent my contracting
                                                COVID-19 and suffering any related injuries, and that I expressly
                                                nevertheless assume all of these risks.
                                            </p>
                                            <p>
                                                With full knowledge of the risks involved, therefore, I hereby release,
                                                waive, and discharge CJMEA, its officers, directors, employees,
                                                contractors, and agents, from any and all liability, loss, damage, claims,
                                                demands, actions, and causes of action whatsoever, including reasonable
                                                attorneys' fees, directly or indirectly arising out of or related to any
                                                loss, damage, injury, or death, that may be sustained by me while
                                                participating in this event or while in, on, or around the event premises
                                                that may lead to exposure or harm due to COVID-19.
                                            </p>
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


