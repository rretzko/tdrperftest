@props([
    'selected' => [],
    'import' => false,
])
<x-inputs.dropdown label="Bulk Actions" key="bulkactions">
    @if(count($selected)) {{-- items have been selected for a bulk action --}}
        <x-inputs.dropdownitem type="button" wire:click="exportSelected" class="flex items-center space-x-1">
            <x-icons.download class="text-gray-400" />
            <span>Download</span>
        </x-inputs.dropdownitem>

        <x-inputs.dropdownitem type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-1">
            <x-icons.trash class="text-gray-400" />
            <span>Delete</span>
        </x-inputs.dropdownitem>

        @if($import)
        <x-inputs.dropdownitem type="button" wire:click="$toggle('showfileuploadmodal')" class="flex items-center space-x-1">
            <x-icons.upload class="text-gray-400" />
            <span wire:click="$toggle('showfileuploadmodal')">Import</span>
        </x-inputs.dropdownitem>
        @endif
    @else {{-- no items selected --}}
        <x-inputs.dropdownitem class="flex items-center space-x-1 cursor-text">
            <x-icons.download class="text-gray-400" />
            <span class="text-gray-400 ">Download (none selected)</span>
        </x-inputs.dropdownitem>

        <x-inputs.dropdownitem class="flex items-center space-x-1 cursor-text">
            <x-icons.trash class="text-gray-400" />
            <span class="text-gray-400">Delete (none selected)</span>
        </x-inputs.dropdownitem>

        @if($import)
            <x-inputs.dropdownitem type="button" wire:click="$toggle('showfileuploadmodal')" class="flex items-center space-x-1">
                <x-icons.upload class="text-gray-400" />
                <span >Import</span>
            </x-inputs.dropdownitem>
        @endif
    @endif

</x-inputs.dropdown>
