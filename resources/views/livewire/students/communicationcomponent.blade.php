<div>
    Emails and Phones for {{ $student->person->fullName }}
    <form wire:submit.prevent="save">
        <x-inputs.group label="Emails (please do not enter duplicate email addresses)" for="emailpersonal">
            <x-inputs.email wire:model="emailpersonal" label="Personal email" for="emailpersonal" initialfocus="1" immediate="true" />
            <x-inputs.email wire:model="emailschool" label="School email" for="emailschool" initialfocus="0" immediate="true" />
        </x-inputs.group>

        <x-inputs.group label="Phone (please do not enter duplicate phone numbers)" for="phonemobile">
            <x-inputs.text wire:model="phonemobile" label="Cell phone" for="phonemobile" initialfocus="0"  />
            <x-inputs.text wire:model="phonehome" label="Home phone" for="phonehome" initialfocus="0"  />
        </x-inputs.group>

        <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
            <x-saves.save-message-without-button message="Communication updated" trigger="communication-saved" />
            <x-buttons.button  wire:click="save" type="submit" >Update {{ ucwords($student->person->fullname) }}</x-buttons.button>
        </footer>
    </form>
</div>
