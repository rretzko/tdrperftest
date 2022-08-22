<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <x-table-with-modal-form >

            <x-slot name="title">
                {{ __('Ensemble Information') }}
            </x-slot>

            <x-slot name="description" >

                {{ __('Add or edit your ensemble information here.') }}

            </x-slot>

            <x-slot name="table">
                {{-- Studio + Schools table --}}
                {{-- ADD button --}}
                <div class="flex justify-end mb-2 pr-6">
                    <div
                        class="bg-green-200 px-1 shadow-lg border border-green-600 rounded-md text-center cursor-pointer"
                        style="max-width: 4rem;"
                    >
                        <a href="{{ route('ensemble.create') }}"
                           class="text-green-800">Add</a>
                    </div>

                </div>

                <div>
                    <table class="min-w-full divide-y divide-gray-200 divide-y">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-center tex-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center tex-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Type
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center tex-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Since
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center tex-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Edit
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center tex-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Delete
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ensembles AS $object)
                            <tr class="@if($loop->iteration % 2) bg-yellow-100 @else bg-white @endif">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top">
                                    {{ $object->name }} ({{$object->abbr}})
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top">
                                    {{ $object->ensembletype->descr }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top">
                                    {{ $object->yearstarted }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                                    <a
                                        href="{{ route('ensemble.edit', ['ensemble' => $object]) }}"
                                        class="border border-blue-500 rounded px-2 bg-blue-400 text-white hover:bg-blue-600"
                                    >Edit</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top">
                                    Delete
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </x-slot>

        </x-table-with-modal-form>
    </div>

    {{-- MODAL FORM --}}
    <div
        style="position: absolute; top:0; left:0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,.6); display: flex; "
    >
        <form method="post" action="{{ route('ensemble.update', ['ensemble' => $ensemble]) }}"
              class="p-4 flex flex-col"
            style="background-color: white; width: 50%; margin: auto;"
        >
            @csrf

            <input type="hidden" name="id" value="{{ $ensemble->id }}" >

            <h3 class="mb-3">Edit {{ $ensemble->name }}</h3>

            <x-inputs.select label="ensemble type" for="ensembletype_id" :options="$types" currentvalue="{{$ensemble->ensembletype_id}}" />
            <x-inputs.checkboxes-in-row label="grades" for="gradetypes" :options="$gradetypes" :currentvalues="$gradetypeidsarray"/>
            <x-inputs.text label="name" for="name" currentvalue="{{$ensemble->name}}"/>
            <x-inputs.text label="abbreviation" for="abbr" currentvalue="{{$ensemble->abbr}}"/>
            <x-inputs.text label="since" for="startyear" currentvalue="{{$ensemble->startyear}}" placeholder="year of inception"/>
            <div class="flex flex-col mt-1 block w-full pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" >
                <label for="descr">Description</label>
                <textarea cols="40" rows="3" name="descr" id="descr">{{ strlen(old('descr')) ? old('descr') : (strlen($ensemble->descr) ? $ensemble->descr : '') }}</textarea>
            </div>

            <div name="footer" class="flex flex-row justify-end space-x-2">
                <a href="{{ route('ensembles.index') }}"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
                >
                    Cancel
                </a>
                <button type="submit"
                   class="px-4 py-2 bg-black border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
                >
                    Update {{ $ensemble->name }}
                </button>
            </div>


        </form>
    </div>
</x-app-layout>
