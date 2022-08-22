<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div>

                <x-livewire-table-with-modal-forms>

                    <x-slot name="title">
                        {{ __($eventversion->name.' Obligations') }}
                    </x-slot>

                    <x-slot name="description">

                        <x-sidebar-blurb blurb="You must acknowledge the following obligations to
                            {{ $eventversion->name }} in order to continue with the student registration process."/>

                    </x-slot>

                    <x-slot name="table">

                        {{-- OBLIGATIONS --}}
                        <style>
                            li{margin-bottom: .5rem;}
                            ul{list-style-type: disc; margin-left: 2rem;}
                        </style>
                        <div class="overflow-x-auto ">
                            @if($eventversion->id === 65)
                                <x-obligations.9.65.obligations />
                            @endif
                            @if($eventversion->id === 66)
                                <x-obligations.12.66.obligations />
                            @endif
                            @if($eventversion->id === 67)
                                    <x-obligations.11.67.obligations />
                            @endif
                            @if($eventversion->id === 68)
                                    <x-obligations.23.68.obligations />
                            @endif
                            @if($eventversion->id === 69)
                                <x-obligations.19.69.obligations />
                            @endif
                            @if($eventversion->id === 70)
                                <x-obligations.1.70.obligations />
                            @endif
                            @if($eventversion->id === 71)
                                <x-obligations.9.71.obligations :eventversion=$eventversion />
                            @endif
                            @if($eventversion->id === 73)
                                <x-obligations.25.73.obligations :eventversion=$eventversion />
                            @endif

                            <!-- {{--
                            <ul>
                                <li>
                                    <b>I understand</b> that I must serve as an Adjudicator at least once every
                                    four years as a FIRST obligation.
                                </li>

                                <li>
                                    <b>Once my students</b> have been accepted into the Mixed or Treble Chorus,
                                    I understand that I must assist at a rehearsal or on the day of the concert as a
                                    SECOND obligation.
                                </li>

                                <li>
                                    <b>I understand</b> that I may be asked to serve any role including attendance-sign in/sign out,
                                    testing, sectional rehearsals (either playing parts or conducting)
                                    as well as supervising the students during rehearsals and concerts.
                                </li>

                                <li>
                                    <b>Should I need</b> to send a substitute, I understand that my substitute must be
                                    a NAfME Member in good standing.
                                </li>

                                <li>
                                    <b>I understand</b> that failure to complete these obligations may result in the
                                    denial of participation for my students.
                                </li>

                            </ul>

                            --}} -->


                            <!-- {{-- <a href="{{ route('eventversion.obligations.update') }}" class="bg-gray-500 rounded text-white px-4 hover:bg-gray-700 text-lg">I have read and acknowledge my obligations.</a> --}} -->
                                @if(config('app.url') === 'http://localhost')
                                    <a href="{{ route('eventversion.obligations.update') }}" class="bg-gray-500 rounded text-white px-4 hover:bg-gray-700 text-lg">I have read and acknowledge my obligations.</a>
                                @else
                                    <a href="https://thedirectorsroom.com/event/obligations/update" class="bg-gray-500 rounded text-white px-4 hover:bg-gray-700 text-lg">I have read and acknowledge my obligations.</a>
                                @endif

                        </div>

                    </x-slot>

                </x-livewire-table-with-modal-forms>

            </div>

        </div>
    </div>

    <x-jet-section-border />

</x-app-layout>
