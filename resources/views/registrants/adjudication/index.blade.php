<x-layouts.adjudicationlayout >

    {{-- PAGE HEADER --}}
    <div class="bg-white w-11/12 m-auto p-2">
        <h2 class="text-center text-xl border-b border-gray-300">
            {{ $eventversion->name }} Adjudication for: <b>{{ $room->descr }}</b>
        </h2>

        <div class=" border-b border-gray-300 pb-2">
            Adjudicators in this room are:
                <div class="flex flex-wrap justify-center space-x-4">
                    @foreach($room['adjudicators'] AS $adjudicator)
                        <div class="border border-black p-2">{!! $adjudicator->bioBlock !!}</div>
                    @endforeach
                </div>
        </div>

        {{-- SUMMARY NUMBERS --}}
        <div class="my-4 flex justify-center border-b border-gray-300">
            <div>This room has:</div>
            <ul class="ml-5">
                <li>Registrants: {{ $registrantscount }}</li>
                <li>Room tolerance: {{ $room->tolerance }}</li>
                <li>Best score is at the top of the drop-down selection.</li>
                <li>Worst score is at bottom of the drop-down selection.</li>
            </ul>
        </div>

        {{-- REGISTRANT IDS --}}
        <div class="flex flex-col pb-1 mb-3 border-b border-gray-300">
            @foreach($registrants AS $id => $registrantsbyinstrumentation)

                <div class="flex flex-col">
                    <header class="font-bold">{{ $id }}</header>
                    <div class="flex flex-wrap">
                        @foreach($registrantsbyinstrumentation->sortBy('id') AS $registrant)

                            <div class="border border-gray-700 text-sm mb-1 mr-1">
                            <!-- {{-- class="text-black {{ $registrant->adjudicationStatusBackgroundColor($room) }} {{ $registrant->judgeScoresEntered(auth()->id()) }}"> --}} -->
                                @if(config('app.url') === 'http://localhost')
                                    <a href="{{ route('registrants.adjudication.show', ['registrant' => $registrant]) }}"
                                    style="background:{{ $registrant->auditionStatus($room) ? $registrant->auditionStatus($room)->auditionstatustype->background : 'aliceblue' }}; color:{{ $registrant->auditionStatus($room) ? $registrant->auditionStatus($room)->auditionstatustype->color : 'black' }};"
                                >
                                        {{ $registrant->id }}
                                    </a>
                                @else
                                    <a href="https://thedirectorsroom.com/registrants/adjudication/registrant/{{ $registrant->id }}"
                                       class="text-black {{ $registrant->adjudicationStatusBackgroundColor($room) }} {{ $registrant->judgeScoresEntered(auth()->id()) }}">
                                        {{ $registrant->id }}
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

            <div id="legend" class="flex flex-row justify-center my-1 text-xs">
                <div class="border border-black px-2" title="No scores found">Unauditioned</div>
                <div class="border border-black px-2 bg-yellow-100" title="Incomplete set of scores found">Partial</div>
                <div class="border border-black px-2 bg-green-100" title="Complete set of scores found">Completed</div>
                <div class="border border-black px-2 bg-red-100" title="Scores are out of tolerance">Tolerance</div>
                <div class="border border-black px-2 bg-blue-100" title="More than expected number of scores found">Excess</div>
                <div class="border border-black px-2 bg-gray-300" title="Something unexpected has occurred">Error</div>
            </div>
        </div>

        {{-- VIEWPORT & SCORING --}}
        <div id="viewport-scoring" class=" space-x-2 mb-4 m-auto border-b border-gray-300 pb-3">
            <div id="viewport">
                <div class="flex justify-center">
                    @if($auditioner)
                        @if($eventversion->eventversionconfigs->virtualaudition)
                            <div class="flex flex-col">
                            <div class="text-center bg-indigo-100 border border-indigo-700">
                                Now adjudicating: {{ $auditioner->id }}: {{ strtoupper($auditioner->instrumentations->first()->abbr) }}
                            </div>
                            <div class=" mb-1">
                                @if(config('app.url') === 'http://localhost')
                                    @foreach($room->filecontenttypes->sortBY('order_by') AS $filecontenttype)
                                        <div  class="flex flex-row flex-wrap mb-1 ">
                                            @if($auditioner->hasFileUploadedAndApproved($filecontenttype))
                                                <!-- {{-- @if(in_array(auth()->id(), $viewers)) --}} -->
                                                    {!! $auditioner->fileviewport($filecontenttype) !!}
                                            <!-- {{-- @else
                                                    Judging only
                                                @endif --}} -->
                                                {{-- $filecontenttype->descr  file viewport here --}}
                                            @else
                                                Missing @if($auditioner->hasFileUploaded($filecontenttype)) approved @endif {{ $filecontenttype->descr }} file.
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($room->filecontenttypes->sortBY('order_by') AS $filecontenttype)
                                        <div class="flex flex-row flex-wrap mb-1 ">
                                            @if($auditioner->hasFileUploadedAndApproved($filecontenttype))
                                                <!-- {{-- @if(in_array(auth()->id(),$viewers)) --}} -->
                                                    {!! $auditioner->fileviewport($filecontenttype) !!}
                                                <!-- {{-- @else
                                                    Judging only
                                                @endif --}} -->
                                            @else
                                                Missing {{ $filecontenttype->descr }} file.
                                            @endif
                                        </div>
                                    @endforeach
                                   <!-- {{--
                                    @if($room->filecontenttypes->count() === 1)
                                        {!! $auditioner->fileviewport($room->filecontenttypes->first()) !!}
                                    @else{
                                        {!! $auditioner->fileviewport(\App\Models\Filecontenttype::find(1)) !!}
                                    @endif
                                    --}} -->
                                @endif
                            </div>
                            <div class="text-center border border-black rounded bg-gray-100">
                                <a href="/registrants/adjudication/{{ $eventversion->id }}" class="text-black">
                                    Cancel
                                </a>
                            </div>
                        </div>
                        @endif
                        <div id="scoring" class="my-4">
                            @if(! $eventversion->eventversionconfigs->virtualaudition)
                                <div class="text-center bg-indigo-100 border border-indigo-700">
                                    Now adjudicating: <b>{{ $auditioner->id }}</b>: {{ strtoupper($auditioner->instrumentations->first()->abbr) }}
                                </div>
                            @endif

                            @if(config('app.url') === 'http://localhost')
                                <form method="post" action="{{ route('registrants.adjudication.update', ['registrant' => $auditioner->id]) }}" >
                            @else
                                <form method="post" action="https://thedirectorsroom.com/registrants/adjudication/registrant/update/{{ $auditioner->id }}" >
                            @endif

                                @csrf

                                <x-adjudication.scoresheets.index
                                    :useradjudicator="$useradjudicator"
                                    :auditioner="$auditioner"
                                    :eventversion="$eventversion"
                                    :room="$room"
                                    :scoringcomponents="$scoringcomponents"
                                />
                                <div class="mt-2 text-center">
                                    <!--
                                    <input class="bg-black text-white rounded px-2" type="submit" name="submit" id="submit" value="Submit" />
                                    -->
                                </div>
                                    <div style="color: darkred; font-size: 0.8rem;">
                                        NOTE: This page will auto-advance to the next registrant on the roster.
                                    </div>
                            </form>
                        </div>

                    @endif
                </div>
            </div>
        </div>

        {{-- ADJUDICATOR RESULTS TABLE --}}
        <div id="adjudicators-table" style="">
            @if($auditioner)
                <style>
                    td,th{border: 1px solid black; padding:0 .25rem;}
                </style>
                <table style="margin: auto;">
                    <thead>
                        <tr>
                            <th
                                style="border-top: 0; border-left: 0; background:{{ $auditioner->auditionStatus($room) ? $auditioner->auditionStatus($room)->auditionstatustype->background : 'aliceblue' }}; color:{{ $auditioner->auditionStatus($room) ? $auditioner->auditionStatus($room)->auditionstatustype->color : 'black' }};">
                                {{ $auditioner->auditionStatus($room) ? $auditioner->auditionStatus($room)->auditionstatustype->descr : 'no-gots'}}
                            </th>
                            @foreach($room->filecontenttypes->sortBy('order_by') AS $filecontenttype)
                                <th colspan="{{ $filecontenttype->scoringcomponents->count() }}">{{ $filecontenttype->descr }}</th>
                            @endforeach
                            <th style="border-top: 0; border-right: 0;"></th>
                        </tr>
                        <tr>
                            <th>Adjudicator</th>
                            @foreach($room->filecontenttypes->sortBy('order_by') AS $filecontenttype)
                                @foreach($filecontenttype->scoringcomponents->sortBY('order_by') AS $scoringcomponent)
                                    <td>{{ $scoringcomponent->abbr }}</td>
                                @endforeach
                            @endforeach
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($room->adjudicators AS $adjudicator)
                            <tr>
                                <td>{{ $adjudicator->person->fullnameAlpha }}</td>
                                @foreach($room->filecontenttypes->sortBy('order_by') AS $filecontenttype)
                                    @foreach($filecontenttype->scoringcomponents->sortBy('order_by') AS $scoringcomponent)
                                        <td>{{ $auditioner->scoringcomponentScore($adjudicator, $scoringcomponent) }}</td>
                                    @endforeach
                                @endforeach
                                <td>{{$adjudicator->registrantScore($auditioner)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>

</x-layouts.adjudicationlayout>
