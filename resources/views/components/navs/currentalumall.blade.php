@props([
    'population' => 'current'
])
<div class="flex">
    <ul class="flex w-full justify-evenly bg-blue-50">
        <li><x-buttons.button-link wire:click.prevent="population('current')" class="{{ ($population === 'current') ? 'text-red-600' : 'text-blue-600' }}" >Current</x-buttons.button-link></li>
        <li><x-buttons.button-link wire:click.prevent="population('alum')" class="{{ ($population === 'alum') ? 'text-red-600' : 'text-blue-600' }}" >Alum</x-buttons.button-link></li>
        <li><x-buttons.button-link wire:click.prevent="population('all')" class="{{ ($population === 'all') ? 'text-red-600' : 'text-blue-600' }}" >All</x-buttons.button-link></li>
    </ul>
</div>
