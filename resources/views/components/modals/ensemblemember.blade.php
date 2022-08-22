@props([
'assets',
'memberschoolyearid',
'confirmingdelete',
'ensemble',
'instrumentations',
'instrumentationid',
'member' => false,
'members' => false,
'nonmembers',
'schoolyears',
'schoolyear_id',
'userid',
])
<div>

    <x-modals.confirmation wire:model="showeditmodal">

        <x-slot name="title">@if($member->id) Edit {!! '<b>'.$member->person->fullName.'</b>' !!} @else Add a New Ensemble Member @endif for {{ $ensemble->name }}</x-slot>

        <x-slot name="content">

            <form wire:submit.prevent="save" id="form-ensemblemember">
                <x-inputs.group label="School Year" for="schoolyear_id" >
                    <x-inputs.select wire:model="editmemberschoolyear_id"
                                     label=""
                                     :options="$schoolyears"
                                     for="editmemberschoolyear_id"
                                     currentvalue="{{ $memberschoolyearid }}"
                    />
                </x-inputs.group>

                <div>
                    @if(! $member->id)
                        <x-inputs.group label="Name" for="name" >

                            <x-inputs.select label="" :options="$nonmembers" for="user_id"
                                             currentvalue="{{ $userid }}"
                                             placeholder="Select nonmember..."
                            />


                        </x-inputs.group>
                    @endif
                </div>

                <x-inputs.group label="Voice Part" for="instrumentation_id" >
                    <x-inputs.select label="" :options="$instrumentations" for="instrumentation_id"
                                     currentvalue="{{ $instrumentationid }}"
                                     placeholder="Select voice part..."
                    />
                </x-inputs.group>

                <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
                    <x-saves.save-message-without-button message="Ensemble member {{ ($member->id) ? 'updated' : 'added' }}" trigger="ensemblemember-saved"/>
                    <x-buttons.button wire:click="save" type="submit">@if($member->id) Update {{ ucwords($member->person->name) }} @else Add New Ensemble member @endif</x-buttons.button>
                    @if($member->id)
                        <x-buttons.button-delete-sure type="submit" id="{{ $member->id}}" confirmingdelete="{{ $confirmingdelete }}"/>
                    @endif

                </footer>
            </form>

            @if($member->user_id)
                <x-forms.ensemblemember-assets :ensemble="$ensemble" :member="$member" :assets="$assets"/>
            @endif

        </x-slot>

        <x-slot name="footer" >
            <x-buttons.secondary wire:click="$toggle('showeditmodal', false)">Cancel</x-buttons.secondary>
        </x-slot>

    </x-modals.confirmation>
</div>
