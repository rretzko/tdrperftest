@props([
'choralinstrumentation',
'instrumentalinstrumentation',
'student',
'tab',
])
<div class="md:grid md:grid-cols-3 md:gap-6 mt-3">
    <div class="md:col-span-1 px-2 py-2">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Instrumentation</h3>
            <p class="mt-1 text-sm text-gray-600">
                Voice parts and instruments for
                <b>{{ $student->person ? $student->person->fullName : 'new student'}}</b>
            </p>
        </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="instrumentations">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                    <div class="shadow overflow-hidden sm:rounded-md">

                        {{-- NEW STUDENT WITHOUT INSTRUMENTATION --}}
                        @if((! $choralinstrumentation->count()) && (! $instrumentalinstrumentation->count()))
                            <div class="mb-2">
                                <table class="ml-6 mt-4 w-10/12">
                                    <thead>
                                        <tr class="border border-black bg-gray-100 ">
                                            <th class="pl-2 text-left w-10/12">
                                                No instrumentation found
                                            </th>
                                            <td class="w-2/12">
                                                <a
                                                    class="text-green-500 text-sm"
                                                    wire:click.prevent="createInstrumentation"
                                                    href="#">
                                                    Add
                                                </a>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        @else
                            <div>
                                <table class="ml-6 mt-4 mb-4 w-10/12">
                                    {{-- INSTRUMENTATIONS: CHORAL TABLE --}}
                                    @if($choralinstrumentation->count())
                                        <thead>
                                        <tr class="border border-black bg-gray-100 ">
                                            <th class="pl-2 text-left w-10/12">Voice
                                                Part{{ ($choralinstrumentation->count() > 1) ? 's' : '' }}</th>
                                            <td class="w-2/12">
                                                <a
                                                    class="text-green-500 text-sm"
                                                    wire:click.prevent="createInstrumentation"
                                                    href="#">
                                                    Add
                                                </a>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($choralinstrumentation AS $instrument)
                                            <tr class="border border-black">
                                                <td class="pl-3 w-10/12">{{ strtoupper($instrument->descr) }}</td>
                                                <td class="w-2/12">
                                                    <a
                                                        class="text-red-700 text-sm"
                                                        wire:click="deleteInstrumentation({{ $instrument->id }})"
                                                        href="#">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>

                            {{-- INSTRUMENTATIONS: INSTRUMENTAL TABLE --}}
                            <div>
                                <table class="ml-6 mt-4 mb-4 w-10/12">
                                    @if($instrumentalinstrumentation->count())
                                        <thead>
                                        <tr class="border border-black bg-gray-100 ">
                                            <th class="pl-2 text-left w-10/12">
                                                Instrument{{ ($choralinstrumentation->count() > 1) ? 's' : '' }}</th>
                                            <td class="w-2/12">
                                                <a
                                                    class="text-green-500 text-sm"
                                                    wire:click.prevent="createInstrumentation"
                                                    href="#">
                                                    Add
                                                </a>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($instrumentalinstrumentation AS $instrument)
                                            <tr class="border border-black">
                                                <td class="pl-3 w-10/12">{{ strtoupper($instrument->descr) }}</td>
                                                <td class="w-2/12">
                                                    <a
                                                        class="text-red-700 text-sm"
                                                        wire:click="deleteInstrumentation({{ $instrument->id }})"
                                                        href="#">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    @endif

                                </table>
                            </div>
                        @endif
                        {{-- SAVED message --}}
                        <x-saves.save-message-without-button message="Instrumentation saved!"
                             trigger="saved-instrumentation"
                        />

                        {{--  REMOVED message --}}
                        <div class="font-italic bg-red-200 p-2"
                             x-data="{show: false}"
                             x-show.transition.duration.500ms="show"
                             x-init="@this.on('removed-instrumentation',() => {
                                    setTimeout(() => { show = false; }, 2500 );
                                    show = true;
                                })"
                        >
                            Instrumentation removed.
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
