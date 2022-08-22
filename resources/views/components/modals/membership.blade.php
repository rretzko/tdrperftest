@props([
'membershipid',
'membershiptypes',
'organization',
'request' => false,
])
<div>
    <x-modals.confirmation wire:model="showeditmodal">

        <x-slot name="title">
            @if($request)The information below will be used to evaluate your <b>{{ $organization->name }}</b>
                membership request.<br />
                Please add/edit for completeness and accuracy.
            @else
                Edit Membership Information for <b>{{ $organization->name }}</b>
            @endif
        </x-slot>

        <x-slot name="content">

            <div id="membership">
                <label style="font-weight: bold;">Membership Information</label>
                <!-- MEMBERSHIP STATUS -->
                <x-inputs.group label="Types" for="editorganizationmembershiptype_id" >
                    <x-inputs.select wire:model="editorganizationmembershiptype_id" label="Membership type" for="editorganizationmembershiptype_id" :options="$membershiptypes"  />
                </x-inputs.group>

                <!-- MEMBERSHIP ID -->
                <x-inputs.group label="Membership Card ID" for="editorganizationmembershipid" >
                    <x-inputs.text wire:model.defer="editorganizationmembershipid" label="" for="editorganizationmembershipid" REQUIRED  />
                </x-inputs.group>

                <!-- MEMBERSHIP EXPIRATION -->
                <x-inputs.group label="Membership Expiration" for="editorganizationexpiration" >
                    <x-inputs.date wire:model="editorganizationexpiration" label="" for="editorganizationexpiration"   />
                </x-inputs.group>

                <!-- GRADE LEVELS -->
                <x-inputs.group label="Grade Levels" for="editorganizationgradelevels" >
                    <x-inputs.text wire:model.defer="editorganizationgradelevels" label="" for="editorganizationgradelevels"   />
                    <div class="hint">ex. Elementary, Middle, Secondary, Collegiate, Adult...</div>
                </x-inputs.group>

                <!-- SUBJECTS -->
                <x-inputs.group label="Subjects" for="editorganizationsubjects" >
                    <x-inputs.text wire:model.defer="editorganizationsubjects" label="" for="editorganizationsubjects"   />
                    <div class="hint">ex. Chorus, Music Theory, Guitar...</div>
                </x-inputs.group>

                <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
                    <x-saves.save-message-without-button message="Membership updated" trigger="membership-saved"/>
                    <x-buttons.button wire:click="saveMembership" type="submit">Update Membership</x-buttons.button>

                    <x-buttons.button wire:click="sendMembershipRequest" type="submit" disable="@if(empty($membershipid)) disabled @endif" >
                        {{$membershipid ? 'Send Membership Request' : 'Add Membership Id' }}
                    </x-buttons.button>
                </footer>

            </div>

        </x-slot>

        <x-slot name="footer" >
            <x-buttons.secondary wire:click="$toggle('showeditmodal', false)">Cancel</x-buttons.secondary>
        </x-slot>

    </x-modals.confirmation>
</div>
