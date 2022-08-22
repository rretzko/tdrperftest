@props([
    'pages' => [5,10,15,20,25,30,40,50],
])
<x-inputs.dropdown label="Per Page" key="perpage">
    @foreach($pages AS $page)
        <x-inputs.dropdownitem
            @click="open = !open"
            type="button"
            wire:click="$set('perpage', {{ $page }})" class="flex items-center"
        >
            {{ $page }}
        </x-inputs.dropdownitem>
    @endforeach

</x-inputs.dropdown>
