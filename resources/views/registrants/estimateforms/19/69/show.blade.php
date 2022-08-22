<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div>

                <x-livewire-table-with-modal-forms>

                    <x-slot name="title">
                        {{ __('Invoice Form') }}
                    </x-slot>

                    <x-slot name="description">

                        <x-sidebar-blurb blurb="Invoice form for: {{ $eventversion->name }}"/>

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

                            {{-- BUTTON TO DOWNLOAD PDF --}}
                            <div class="bg-blue-400 text-xs pt-3 border rounded-2xl text-white px-2">
                                @if(config('app.url') === 'http://localhost')
                                    <a href="{{ route('registrant.estimateform.download', ['eventversion' => $eventversion]) }}">
                                @else
                                    <a href="https://thedirectorsroom.com/registrant/estimateform/{{ $eventversion->id }}/download">
                                @endif
                                    Download Invoice Form
                                </a>
                            </div>
                        </div>

                        {{-- ESTIMATE FORM --}}
                        <div class="my-2 overflow-x-auto sm:mx-2 lg:mx-2 ">

                            {{-- BANNER --}}
                            <div class="flex flex-col">
                                <div class="uppercase border-b text-center font-bold mb-4">
                                    {{ $eventversion->name }}
                                </div>
                                <div class="text-sm">
                                    <div class="uppercase text-center">
                                        Mail to: Emily Kneuer, Treasurer
                                    </div>
                                    <div class="uppercase text-center">
                                        Raritan High School
                                    </div>
                                    <div class="uppercase text-center">
                                        419 Middle Road
                                    </div>
                                    <div class="uppercase text-center">
                                        Hazlet, NJ 07730
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4"/>

                            <div id="titles" class="flex flex-col text-center">
                                <div>
                                    ALL-SHORE INVOICE
                                </div>
                                <div>
                                    {{ $eventversion->name }}
                                </div>
                                <div>
                                    STUDENT AUDITION FEES INVOICE
                                </div>
                                <div class="my-4">
                                    $15.00 Per Student
                                </div>
                                <div class="mb-4">
                                    Due: November 3<sup>rd</sup>, 2021
                                </div>
                                <div>
                                    Please send one check for all students auditioning at your school.<br />
                                    Please make out all checks to "All-Shore Chorus Inc".
                                </div>
                            </div>
                            <hr class="my-4"/>

                            <style>
                                label{width: 25rem;}
                                .data{font-weight: bold;}
                            </style>
                            <div id="invoice_data">
                                <div class="flex flex-row">
                                    <label>School</label>
                                    <div class="data">{{ $school->shortName }}</div>
                                </div>
                                <div class="flex flex-row">
                                    <label>Date</label>
                                    <div class="data">{{ \Carbon\Carbon::now()->format('d-M-Y') }}</div>
                                </div>
                                <div class="flex flex-row">
                                    <label>Number of Students Auditioning</label>
                                    <div class="data">{{ $registrants->count() }}</div>
                                </div>
                                <div class="flex flex-row">
                                    <label>Choral Director</label>
                                    <div class="data">{{ auth()->user()->person->fullName }}</div>
                                </div>
                                <div class="flex flex-row">
                                    <label>Total amount enclosed: (# of students x $15.00)</label>
                                    <div class="data">${{ number_format(($registrants->count() * $eventversion->eventversionconfigs->registrationfee), 2) }}</div>
                                </div>
                            </div>
                        </div>

                    </x-slot>

                </x-livewire-table-with-modal-forms>

            </div>

        </div>
    </div>

    <x-jet-section-border />

</x-app-layout>
