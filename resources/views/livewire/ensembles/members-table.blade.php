<div>
    <div id="schoolYear" class="flex mb-3">
        <label for="schoolyear_id" class="h-8 pt-2">School Year: </label>
        <select wire:model="schoolyear_id" name="schoolyear_id" id="schoolyear_id" class="h-8 mx-2 text-sm">
            @foreach($schoolyears AS $schoolyear_obj)
                <option value="{{ $schoolyear_obj->id }}"
                        class="text-xs"
                >{{ $schoolyear_obj->descr }}</option>
            @endforeach
        </select>
        <label for="schoolyear_id" class="h-8 pt-2">has {{ $countmembers }} members ({{ $schoolyear_id }})</label>
    </div>
</div>

<div wire:model="ensemblemembers">
    <x-tables.surgetable>
        <x-slot name="head">
            <x-tables.heading sortable direction="asc">Name</x-tables.heading>
            <x-tables.heading sortable direction="asc">Voice Part</x-tables.heading>
            <x-tables.heading><span class="sr-only">Edit</span></x-tables.heading>
            <x-tables.heading><span class="sr-only">Delete</span></x-tables.heading>
        </x-slot>

        <x-slot name="body">
            @forelse($ensemblemembers AS $ensemblemember)
                <x-tables.row altcolor="{{$loop->iteration % 2}}">
                    <x-tables.cell>
                        {{ $ensemblemember->person->fullName }}
                    </x-tables.cell>
                    <x-tables.cell>
                        {{ $ensemblemember->instrumentation->formattedDescr() }}
                    </x-tables.cell>
                    <x-tables.cell>
                        <a
                            href="{{ route('ensemble.members.edit',['ensemblemember' => $ensemblemember]) }}"
                            class="border border-blue-500 rounded px-2 bg-blue-400 text-white hover:bg-blue-600"
                        >
                            Edit
                        </a>
                    </x-tables.cell>
                    <x-tables.cell>
                        <a
                            href="{{ route('ensemble.members.destroy') }}"
                            class="border border-red-500 rounded px-2 bg-red-400 text-white hover:bg-red-600"
                            onclick="return chickenTest({{$ensemblemember}});"
                        >
                            Delete
                        </a>
                    </x-tables.cell>
                </x-tables.row>
            @empty
                <x-tables.row>
                    <x-tables.cell colspan="4">No members found</x-tables.cell>
                </x-tables.row>
            @endforelse

        </x-slot>
    </x-tables.surgetable>
</div>
<div class="mt-3">
    {{ $ensemblemembers->links() }}
</div>
