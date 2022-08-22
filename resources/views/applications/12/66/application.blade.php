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
                        </div>
                        --}} -->

                        <style>
                            .sectionheader{background-color: lightgray; padding-left: .5rem; font-weight: bold;}
                        </style>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="flex text-xl my-4" >

                                        <div class="justify-self-center w-full">
                                            <div class="font-bold text-center">SOUTH JERSEY Jr. & SR. HIGH CHORUS APPLICATION</div>
                                            <div class="text-center">{{ $eventversion->name }}</div>
                                            <div class="text-center text-sm">
                                                All signatures must be written clearly in ink and every category must
                                                be filled or the student will not be permitted to audition.
                                            </div>
                                        </div>

                                    </div>

                                    {{-- STUDENT DETAIL DECLARATION --}}
                                    <div style="mb-4">
                                        <style>
                                            .detail-row{display:flex; width: 90%;}
                                            .detail-row label{width: 25%;}
                                            .detail-row .data{font-weight: bold; margin-left: .5rem;}
                                        </style>
                                        <div class="detail-row">
                                            <label>Student Name:</label>
                                            <div class="data">{{ $registrant->student->person->fullName }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Address:</label>
                                            <div class="data">{{ $registrant->student->person->user->address->addressCsv }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Height (in shoes):</label>
                                            <div class="data">{{ $registrant->student->heightFootInch }}</div>
                                        </div>

                                        <div class="detail-row mt-4">
                                            <label>Home Phone:</label>
                                            <div class="data">{{ $registrant->student->phoneHome->id ? $registrant->student->phoneHome->phone : '' }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Cell Phone:</label>
                                            <div class="data">{{ $registrant->student->phoneMobile->id ? $registrant->student->phoneMobile->phone : ''}}</div>
                                        </div>

                                        <div class="detail-row mt-4">
                                            <label>Email Personal:</label>
                                            <div class="data">{{ $registrant->student->emailPersonal->id ? $registrant->student->emailPersonal->email : '' }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Email School:</label>
                                            <div class="data">{{ $registrant->student->emailSchool->id ? $registrant->student->emailSchool->email : '' }}</div>
                                        </div>
                                    </div>

                                    {{-- EMERGENCY CONTACT INFORMATION --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Emergency Contact Information
                                        </div>
                                        <div class="detail-row">
                                            <label>Parent Name:</label>
                                            <div class="data">{{ $registrant->student->guardians->count() ? $registrant->student->guardians->first()->person->fullName : '' }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Parent Phone:</label>
                                            <div class="data">{{ $registrant->student->guardians->count() ? $registrant->student->guardians->first()->phoneCsv : '' }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Parent Email:</label>
                                            <div class="data">{{ $registrant->student->guardians->count() ? $registrant->student->guardians->first()->emailCsv : '' }}</div>
                                        </div>
                                    </div>

                                    {{-- CHORAL DIRECTOR INFORMATION --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Choral Director Information
                                        </div>
                                        <div class="detail-row">
                                            <label>Choral Director:</label>
                                            <div class="data">{{ auth()->user()->person->fullName }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Phones:</label>
                                            <div class="data">{{ auth()->user()->person->subscriberPhoneCsv }}</div>
                                        </div>
                                    </div>

                                    {{-- AUDITION INFORMATION --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Audition Information
                                        </div>
                                        <div class="detail-row">
                                            <label>Grade:</label>
                                            <div class="data">{{ $registrant->student->gradeClassof }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Preferred Pronoun:</label>
                                            <div class="data">{{ $registrant->student->person->pronoun->descr }}</div>
                                        </div>
                                        <div class="detail-row">
                                            <label>Voice Part:</label>
                                            <div class="data">{{ $registrant->instrumentations->first()->formattedDescr() }}</div>
                                        </div>
                                    </div>

                                    {{-- ENDORSEMENT --}}
                                    <div class="mb-4">
                                        <div class="sectionheader" >
                                            Endorsements - Signatures Required
                                        </div>
                                        <div class=" justify-self-stretch mx-4 mb-4">
                                            We, the undersigned, recommend <b>{{ $registrant->student->person->fullName }}</b>
                                            to audition for the {{ $eventversion->name }}.  <b>{{ $registrant->student->person->first }}</b>
                                            is aware of the fact that {{ $registrant->student->person->pronoun->personal }}
                                            must remain an active member in good standing of the school performing group
                                            throughout {{ $registrant->student->person->pronoun->possessive }} South
                                            Jersey experience.  {{ ucwords($registrant->student->person->pronoun->personal) }}
                                            is a qualified student, and is now enrolled in Grade {{ $registrant->student->grade }}
                                            at <b>{{ $registrant->student->currentSchoolName }}</b>.
                                            In the event that <b>{{ $registrant->student->person->fullName }}</b> is
                                            accepted for membership in this chorus, we will use our influence to see that
                                            {{ $registrant->student->person->pronoun->personal }} is properly prepared,
                                            and all whose signatures appear on this application will adhere to the Rules
                                            and Regulations of the South Jersey Chorus.  We agree to the stated
                                            attendance policy and all relevant policies stated in the SJCDA Choral
                                            auditions packet.  Students will be removed from the chorus at any time if a
                                            jury of choral directors selected by the Festival Coordinator determines the
                                            student cannot capably perform their music, or if the student failes to meet
                                            the requirements outlined in this packet.
                                        </div>

                                    </div>

                                    {{-- SIGNATURES HEADER --}}
                                    <div class="mb-4">
                                        <div class="text-center">
                                            ALL SIGNATURES MUST BE ORIGINAL
                                        </div>
                                        <div class="text-center">
                                            NO SIGNATURE STAMPS OR PHOTOCOPIED SIGNATURES ARE ALLOWED
                                        </div>
                                    </div>

                                    {{-- SIGNATURES --}}
                                    <div class="mb-4">

                                        <div class="signature-line mx-4">
                                            <div class="signature-line-line flex justify-between">
                                                <div>{{ str_repeat('_',40) }}</div>
                                                <div>{{ str_repeat('_',40) }}</div>
                                            </div>
                                            <div class="signature-line-signature flex w-full">
                                                <div class="text-center w-6/12">Principal Signature</div>
                                                <div class="text-center w-6/12">{{ auth()->user()->person->fullName }} Signature</div>
                                            </div>
                                        </div>

                                        <div class="signature-line mx-4">
                                            <div class="signature-line-line flex justify-between">
                                                <div>{{ str_repeat('_',40) }}</div>
                                                <div>{{ str_repeat('_',40) }}</div>
                                            </div>
                                            <div class="signature-line-signature flex w-full">
                                                <div class="text-center w-6/12">Parent/Guardian Signature</div>
                                                <div class="text-center w-6/12">{{ $registrant->student->person->fullName }} Signature</div>
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


