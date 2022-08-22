@props([
'toggle'
])
<div
    wire:click="$set('{{ $toggle }}', 'true')"
    class="bg-green-200 px-0.5 shadow-lg border border-green-600 rounded-md text-center cursor-pointer" style="max-width: 4rem;"
>
    Add
</div>
