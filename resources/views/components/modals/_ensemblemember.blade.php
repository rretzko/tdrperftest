@props([
'member',
'members',
'nonmembers',
])
<div>
    <x-modals.confirmation wire:model="showeditmodal">

        <x-slot name="title">@if($member->user_id) Edit {{ $member->person->fullName }} @else Add a New Ensemble Member@endif</x-slot>

        <x-slot name="content">

            <form wire:submit.prevent="save">
                <x-inputs.group label="Name" for="name" >
                    <x-inputs.select label="" :options="$nonmembers" for="user_id"
                                     currentvalue="0"/>
                </x-inputs.group>

                <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
                    <x-saves.save-message-without-button message="Ensemble member{{ ($member->user_id) ? 'updated' : 'added' }}" trigger="ensemblemember-saved"/>
                    <x-buttons.button wire:click="save" type="submit">@if($member->user_id) Update {{ ucwords($member->person->name) }} @else Add New Ensemble member @endif</x-buttons.button>
                </footer>
            </form>

        </x-slot>

        <x-slot name="footer" >
            <x-buttons.secondary wire:click="$toggle('showeditmodal', false)">Cancel</x-buttons.secondary>
        </x-slot>

    </x-modals.confirmation>
</div>
