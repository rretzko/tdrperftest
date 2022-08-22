<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <x-table-with-modal-form >

            <x-slot name="title">
                {{ __('Ensemble Member Roster') }}
            </x-slot>

            <x-slot name="description" >

                {!! __('Add or edit your ensemble membership roster here.<br />
<ul class="ml-5 list-disc text-white text-sm" >
<li>Click the number under the "Members" column to add/edit ensemble membership.</li>
<li>Ensemble names are unique to you and your school.  Please do not delete ensembles which have members assigned.</li>
<li>If necessary, deleted Ensembles can be reinstated by contacting
<a style="color: yellow" href="mailto:support@thedirectorsroom.com?subject=Ensemble reinstatement&body=Hi, I may need an ensemble name reinstated...">
Support
</a>.
</li>
</ul>') !!}

            </x-slot>

            <x-slot name="table">
                {{-- HEADER --}}
                <div id="membershipHeader">
                    <h3 class="font-bold">{{ $ensemble->name }} Membership Roster</h3>
                </div>
                <div id="schoolYear" class="flex">
                    <label for="schoolyear_id" class="h-8 pt-2">School Year: </label>
                    <select name="schoolyear_id" id="schoolyear_id" class="h-8 ml-2 text-sm">
                        @foreach($schoolyears AS $schoolyear_obj)
                            <option value="{{ $schoolyear_obj->id }}" class="text-xs"
                                {{ $schoolyear->id == $schoolyear_obj->id ? 'SELECTED' : '' }}
                            >
                                {{ $schoolyear_obj->descr }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ADD button --}}
                <div class="flex justify-end mb-2 pr-6">
                    <div
                        class="bg-green-200 px-1 shadow-lg border border-green-600 rounded-md text-center cursor-pointer"
                        style="max-width: 4rem;"
                    >
                        <a href="{{ route('ensemble.members.create', ['ensemble' => $ensemble, 'schoolyear' => $schoolyear]) }}"
                           class="text-green-800">Add</a>
                    </div>

                </div>

                <div class="overflow-x-auto">
                    <table class="table-auto overflow-scroll">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Voice Part
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($ensemble->members() AS $object)
                            <tr class="@if($loop->iteration % 2) bg-yellow-100 @else bg-white @endif">
                                <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-900 align-text-top">
                                    {{ $object->person->fullName }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                                    {{ $object->instrumentation->descr }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                                    <a
                                        href="{{ route('ensemble.members.edit', ['ensemblemember' => $object]) }}"
                                        class="border border-blue-500 rounded px-2 bg-blue-400 text-white hover:bg-blue-600"
                                    >
                                        Edit
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                                    <a
                                        href="{{ route('ensemble.members.destroy', ['member' => $object]) }}"
                                        class="border border-red-500 rounded px-2 bg-red-400 text-white hover:bg-red-600"
                                        onclick="return chickenTest({{$object}});"
                                    >
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No members found</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    <script>
                        function chickenTest($object)
                        {
                            return confirm('Do you really want to delete the member?');
                        }
                    </script>
                </div>

            </x-slot>

        </x-table-with-modal-form>
    </div>

    {{-- MODAL FORM --}}
    <div
        style="position: absolute; top:0; left:0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,.6); display: flex; "
    >
        <form method="post" action="{{ route('ensemble.members.update', $ensemblemember) }}"
              class="p-4 flex flex-col"
              style="background-color: white; width: 50%; margin: auto;"
        >
            @csrf

            <input type="hidden" name="id" value="{{ $ensemblemember->user_id }}" >

            {{-- MODAL HEADER --}}
            <h3 class="mb-3">Edit
                <b>{{ $ensemblemember->person->fullName }}</b>
                membership in
                <b>{{ $ensemble->name }}</b>
                for school year
                <b>{{ $ensemblemember->schoolyear->descr }}</b>
            </h3>

            <div>
                <label for="instrumentation_id">
                    {{ $ensemble->ensembletype->instrumentations->first()->instrumentationbranch->descr == 'choral'
                        ? 'Voice Part'
                        : 'Instrument'
                    }}
                </label>
                <select name="instrumentation_id">
                    @foreach($ensemble->ensembletype->instrumentations AS $instrument)
                        <option value="{{ $instrument->id }}"
                            {{ $ensemblemember->instrumentation_id == $instrument->id ? 'SELECTED' : '' }}
                        >
                            {{ $instrument->formattedDescr() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div name="footer" class="flex flex-row justify-end space-x-2">
                <a href="{{ route('ensemble.members.index', ['ensemble' => $ensemble]) }}"
                   class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
                >
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-black border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
                >
                    Update {{ $ensemblemember->person->fullName }}'s record
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
