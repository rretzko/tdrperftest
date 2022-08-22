<x-app-layout>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <x-table-with-modal-form >

                <x-slot name="title" >
                    {{ __('Ensemble Information') }}
                </x-slot>

                <x-slot name="description" >

{!! __('Add or edit your ensemble information here.<br />
<ul class="ml-5 list-disc text-white text-sm" >
<li>Click the number under the "Members" column to add/edit ensemble membership.</li>
<li>Ensemble names are unique to you and your school.</li>
<li>Please <span class="uppercase font-bold">do not delete</span> ensembles which have members assigned.</li>
<li>If necessary, deleted Ensembles can be reinstated by contacting
<a style="color: yellow" href="mailto:support@thedirectorsroom.com?subject=Ensemble reinstatement&body=Hi, I may need an ensemble name reinstated...">
Support
</a>.
</li>
</ul>') !!}

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
            @foreach($ensembles AS $object)
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
                        > --}} -->
                            Delete
                        <!-- </a> -->
                    </td>
                </tr>
            @endforeach
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
