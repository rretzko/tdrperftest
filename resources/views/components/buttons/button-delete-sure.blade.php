@props([
'confirmingdelete',
'id',
])
<div class="flex align-middle">
    @if($confirmingdelete==$id)
        <x-buttons.button-link
            wire:click="delete({{ $id }})"
            class="border border-red-500 rounded px-2 bg-red-500 text-white hover:bg-red-600"
            key="{{ $id }}"
            title="Click to confirm deletion..."
        >
            Confirm
        </x-buttons.button-link>

    @else
        <x-buttons.button-link
            wire:click="delete({{ $id }})"
            class="border border-red-300 rounded px-2 bg-red-300 text-white hover:bg-red-600"
            key="{{ $id }}"
        >
            Delete
        </x-buttons.button-link>
    @endif
</div>
