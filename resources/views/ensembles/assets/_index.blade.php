<x-app-layout>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <x-table-with-modal-form >

                <x-slot name="title" >
                    {{ __($ensemble->name.' Assets') }}
                </x-slot>

                <x-slot name="description" >

                    {!! __('Add or edit your ensemble asset here.<br/>
                    Ensemble assets are anything which you assign to an ensemble member.<br/>
                    Click any checkbox to add an asset to <b>'.$ensemble->name.'</b> for
                    <b>'.$schoolyear->descr.'</b>.<br/>
                    Click the "Add" button to add a new asset.') !!}

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
                    Type
                </th>
                <th scope="col"
                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                    Since
                </th>
                <th scope="col"
                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                    Members
                </th>
                <th scope="col"
                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                    <span class="sr-only">Edit</span>
                </th>
                <th scope="col"
                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                    <span class="sr-only">Assets</span>
                </th>
                <th scope="col"
                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                    <span class="sr-only">Delete</span>
                </th>
            </tr>
        </thead>
        <tbody>
  <!-- {{--          @foreach($ensembles AS $object)
                <tr class="@if($loop->iteration % 2) bg-yellow-100 @else bg-white @endif">
                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-900 align-text-top">
                        {{ $object->name }} ({{$object->abbr}})
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                        {{ $object->ensembletype->descr }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                        {{ $object->startyear }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                        <a href="{{ route('ensemble.members.index', ['ensemble' => $object]) }}"
                           class="text-blue-600"
                           title="Add/Edit {{ $object->name }} members"
                        >
                            {{ $object->members()->count() }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                        <a
                            href="{{ route('ensemble.edit', ['ensemble' => $object]) }}"
                            class="border border-blue-500 rounded px-2 bg-blue-400 text-white hover:bg-blue-600"
                        >
                            Edit
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                        <a
                            href="{{ route('ensemble.assets.index', ['ensemble' => $object]) }}"
                            class="border border-indigo-500 rounded px-2 bg-indigo-400 text-white hover:bg-blue-600"
                        >
                            Assets
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-center">
                        <!-- {{-- <a
                            href="{{ route('ensemble.destroy', ['ensemble' => $object]) }}"
                            class="border border-red-500 rounded px-2 bg-red-400 text-white hover:bg-red-600"
                            onclick="return chickenTest({{$object}});"

                            Delete
                        <!-- </a> -->
                    </td>
                </tr>
            @endforeach
        --}} -->
        </tbody>
    </table>
    <script>
        function chickenTest($object)
        {
            if($object) {
                return confirm('Do you really want to delete the ensemble?');
            }else{
                return false;
            }
        }
    </script>
</div>
</x-slot>

</x-table-with-modal-form>

<x-jet-section-border />

</div>

</x-app-layout>
