<div>
    Home Address for {{ $student->person->fullName }}
    <form wire:submit.prevent="save">
        <x-inputs.group label="Address" for="address01">
            <x-inputs.text wire:model="address01" label="" for="address01" initialfocus="1" />
            <x-inputs.text wire:model="address02" label="" for="address02" initialfocus="0" />
        </x-inputs.group>

        <x-inputs.group label="City" for="city">
            <x-inputs.text wire:model="city" label="" for="city" initialfocus="0"  />
        </x-inputs.group>

       <x-inputs.group label="State" for="geostate_id">
            <x-inputs.select wire:model="geostate_id" label="" for="geostate_id" initialfocus="0" :options="$geostates" />
        </x-inputs.group>

        <x-inputs.group label="Zip code" for="postalcode">
            <x-inputs.text wire:model="postalcode" label="" for="postalcode" initialfocus="0" />
        </x-inputs.group>

        <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
            <x-saves.save-message-without-button message="Home address updated" trigger="homeaddress-saved" />
            <x-buttons.button  wire:click="save" type="submit" >Update {{ ucwords($student->person->fullname) }}</x-buttons.button>
        </footer>
    </form>
</div>
