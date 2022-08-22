<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <x-table-with-modal-form >

            <x-slot name="title">
                {{ __('Asset Information') }}
            </x-slot>

            <x-slot name="description" >

                {{ __('Add or edit <b>'.$ensemble->name.'</b> asset(s) here.') }}

            </x-slot>

            <x-slot name="table">
                {{-- Studio + Schools table --}}
                {{-- ADD button --}}
                <div class="flex justify-end mb-2 pr-6">
                    <div
                        class="bg-green-200 px-1 shadow-lg border border-green-600 rounded-md text-center cursor-pointer"
                        style="max-width: 4rem;"
                    >
                        <a href="{{ route('ensemble.assets.create', [$ensemble, $schoolyear]) }}"
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
       <!-- {{--                 @foreach($ensembles AS $ensemble)
                            <tr class="@if($loop->iteration % 2) bg-yellow-100 @else bg-white @endif">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top">
                                    {{ $ensemble->name }} ({{$ensemble->abbr}})
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top">
                                    {{ $ensemble->ensembletype->descr }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top">
                                    {{ $ensemble->yearstarted }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                                    <a
                                        href="{{ route('ensemble.edit', ['ensemble' => $ensemble]) }}"
                                        class="border border-blue-500 rounded px-2 bg-blue-400 text-white hover:bg-blue-600"
                                    >Edit</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top">
                                    Delete
                                </td>
                            </tr>
                        @endforeach
--}} -->
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
        <form method="post" action="{{ route('ensemble.assets.store', [$ensemble, $schoolyear]) }}"
              class="p-4 flex flex-col"
            style="background-color: white; width: 50%; margin: auto;"
        >
            @csrf

            <input type="hidden" name="id" value="0" >

            <h3 class="mb-3">Add a new asset to <b>{{ $ensemble->name }}</b> for <b>{{ $schoolyear->descr }}</b></h3>

            <x-inputs.text label="Asset name" for="descr"/>

            <div name="footer" class="flex flex-row justify-end space-x-2">
                <a href="{{ route('ensemble.assets.index', [$ensemble]) }}"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
                >
                    Cancel
                </a>
                <button type="submit"
                   class="px-4 py-2 bg-black border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
                >
                    Add asset
                </button>
            </div>


        </form>
    </div>
</x-app-layout>
