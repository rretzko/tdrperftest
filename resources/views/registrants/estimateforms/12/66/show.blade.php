<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div>

                <x-livewire-table-with-modal-forms>

                    <x-slot name="title">
                        {{ __('Estimate Form') }}
                    </x-slot>

                    <x-slot name="description">

                        <x-sidebar-blurb blurb="Estimate form for: {{ $eventversion->name }}"/>

                    </x-slot>

                    <x-slot name="table">

                        <div class="flex justify-between">
                            {{-- BACK TO ROSTER --}}
                            <div class="flex text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 20 20"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                <a href="{{ route('registrants.index',['eventversion' => $eventversion]) }}"
                                   class="text-red-700 ml-2 pb-4">
                                    Return to Registrant Roster
                                </a>
                            </div>

                            {{-- PAYPAL BUTTON --}}
                            <div class="bg-yellow-300 px-2 pt-3 rounded-2xl font-bold">
                                <a href="{{ route('registrant.paypal') }}" class="bg-yellow-300 text-blue-700">
                                    Pay via PayPal
                                </a>
                            </div>

                            {{-- BUTTON TO DOWNLOAD PDF --}}
                            <div class="bg-blue-400 text-xs pt-3 border rounded-2xl text-white px-2">
                                @if(config('app.url') === 'http://localhost')
                                    <a href="{{ route('registrant.estimateform.download', ['eventversion' => $eventversion]) }}">
                                @else
                                    <a href="https://thedirectorsroom.com/registrant/estimateform/{{ $eventversion->id }}/download">
                                @endif
                                    Download Estimate Form
                                </a>

                            </div>

                        </div>

                        {{-- ESTIMATE FORM --}}
                        <div class="my-2 overflow-x-auto sm:mx-2 lg:mx-2">

                            {{-- BANNER --}}
                            <header class="">

                                <div class="flex flex-col">
                                    <div class="uppercase text-center">
                                        STUDENT ESTIMATE FORM
                                    </div>

                                    <div class="uppercase border-b text-center">
                                        {{ $eventversion->name }}
                                    </div>

                                </div>
                            </header>

                            {{-- ADVISORY 1/2 --}}
                            <div class="border border-black p-2 text-center mb-1">
                                Voice part changes may not be made after the <b>November 8, 2021</b>.<br />
                                ALL changes must be sent in writing (preceeded by a phone call) and MUST be signed
                                by the student & choral director.
                            </div>

                            {{-- ADVISORY 2/2 --}}
                            <div class="border border-black p-2 text-center mb-2">
                                <b><u>PLEASE NOTE</u></b>: The Jr High Chorus <b><u>DOES NOT</u></b> use divisi
                                Tenor or Bass for auditions.  Also, if you are sending students to both choruses,
                                you must send the correct copy to <b><u>EACH</u></b> manager.
                            </div>

                            {{-- DIRECTORS INFORMATION --}}
                            <style>
                                label{width: 10rem;}
                                .data{font-weight: bold;}
                                .input-group{display: flex; flex-direction: row;}
                            </style>
                            <div class="mb-3">
                                <h4 class="text-center data">Director's Information</h4>

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
                                    <label for="">Director email:</label>
                                    <span class="data">{!! auth()->user()->person->subscriberemailsStacked !!}</span>
                                </div>
                                <div class="input-group">
                                    <label for="">Director Phone(s):</label>
                                    <span class="data">{{ auth()->user()->person->subscriberPhoneCsv }}</span>
                                </div>
                                <!--
                                <div class="input-group sr_only">
                                    <label for="">Other schools travelling with you:</label>
                                    <span class="data">_____________________________________</span>
                                </div>
                                -->
                            </div>

                            {{-- TEACHER PLEDGE --}}
                            <div>
                                <h4><b><u>TEACHER PLEDGE</u></b></h4>
                                <div>
                                    I agree to be preent and assist in any capacity (judging, warm-up, registration, etc.)
                                    at the South Jersey Auditions until the conclusion of any duties as determined by the
                                    Auditions Coordinator and manager.  I also agree to assist the managers at the
                                    necessary rehearsals and/or concerts if I have any students accepted into either
                                    choruses.  I further certify that I am a member of <i>NAfME</i> and have attached a copy
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

                            {{-- REGISTRANT ROSTER --}}
                            <div class="flex flex-col">

                                {{-- HEADER --}}
                                <h2 class="text-center w-full border-b">
                                    {{ $eventversion->eventversionconfigs->max_count }} STUDENTS MAXIMUM
                                </h2>

                                <h3 class="text-center w-full border-b" style="color: darkred; font-weight: bold;">
                                   YOUR REGISTERED STUDENTS WILL BE AUTOMATICALLY DISPLAYED BELOW.<br />
                                    HANDWRITTEN ENTRIES WILL <u>NOT</u> BE ACCEPTED.
                                </h3>

                                {{-- ROSTER TABLE --}}
                                <style>
                                    table{border-collapse: collapse;}
                                    td,th{border: 1px solid black; padding: 0 .25rem;}
                                </style>
                                <table class="mb-4">
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
                                                <td class="text-center">{{ ($i + 1) }}</td>
                                                <td class="">{{ $registrants[$i]->student->person->fullNameAlpha }}</td>
                                                <td class="text-center">{{ $registrants[$i]->instrumentations->first()->descr }}</td>
                                                <td class="text-center">{{ $registrants[$i]->student->grade }}</td>
                                                <td class="text-center">${{ $eventversion->eventversionconfigs->registrationfee * ($i + 1) }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="text-center">{{ ($i + 1) }}</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center">${{ $eventversion->eventversionconfigs->registrationfee * ($i + 1) }}</td>
                                            </tr>
                                        @endif

                                    @endfor
                                    </tbody>
                                </table>

                                {{-- SUMMARY TABLE --}}
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="border-l-0 border-t-0 "></th>
                                        @foreach($eventversion->instrumentations() AS $instrumentation)
                                            <th class="uppercase">{{ $instrumentation->abbr }}</th>
                                        @endforeach
                                        <th>PayPal</th>
                                        <th>Total Enclosed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Voice Part Totals</td>
                                        @foreach($eventversion->instrumentations() AS $instrumentation)
                                            <th class="{{ (! $registrantsbyinstrumentation[$instrumentation->id]) ? 'text-gray-300' : '' }}">
                                                {{ $registrantsbyinstrumentation[$instrumentation->id] }}
                                            </th>
                                        @endforeach
                                        <td class="text-center">${{ number_format($paypalcollected, 2) }}</td>
                                        <td class="text-center">${{ $amountduenet }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </x-slot>

                </x-livewire-table-with-modal-forms>

            </div>

        </div>
    </div>

    <x-jet-section-border />

</x-app-layout>
