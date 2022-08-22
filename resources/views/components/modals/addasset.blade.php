@props([
'editasset' => false,
'editassetdescr' => '',
'ensemble',
'schoolyear',
])
<div>
    <x-modals.confirmation wire:model="showeditmodal">

        <x-slot name="title">{{ $editasset ? 'Edit asset for ' : 'Add a new to ' }}{{ $ensemble->name }}...</x-slot>

        <x-slot name="content">

            <form wire:submit.prevent="{{ $editasset ? 'update' : 'save' }}">
                <x-inputs.group x-data x-init="$refs.descr.focus()" label="Asset Name" for="editassetfor" >
                    <x-inputs.text wire:model="editassetdescr" label="" x-ref="descr" for="editassetdescr" placeholder=""  />
                </x-inputs.group>

                <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
                    <x-saves.save-message-without-button message="Asset {{ $editasset ? 'updated' : 'saved' }}" trigger="asset-saved"/>
                    <x-buttons.button wire:click="{{ $editasset ? 'update' : 'save' }}" type="submit">{{ $editasset ? 'Update' : 'Add' }} {{ ucwords($ensemble->name) }} Asset</x-buttons.button>
                </footer>
            </form>

        </x-slot>

        <x-slot name="footer" >
            <x-buttons.secondary wire:click="$toggle('showeditmodal', false)">Cancel</x-buttons.secondary>
        </x-slot>

    </x-modals.confirmation>
</div>
