<div>
    <div class="flex justify-between">
        <div>
            @if($guardians->count() > 1) Guardians @else Guardian @endif for {{ $student->person->fullName }}
        </div>
        <div>
            <x-buttons.button-add toggle="addguardian" />
        </div>
    </div>


    @if($guardians->count())
        <table class="w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th class="sr-only">Edit</th>
                    <th class="sr-only">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guardians AS $key => $guardian)

                    <tr>
                        <td>{{ $guardian->person->fullName.' ('.$guardian->user_id.')' }}</td>
                        <td>{{ $guardian->guardiantype($student->user_id)->descr.' ('.$selecteduserid.')' }}</td>
                        <td>
                            <x-buttons.button-link
                                wire:click.defer="edit({{ $guardian->user_id }})"
                                class="border border-blue-500 rounded px-2 bg-blue-400 text-white hover:bg-blue-600"
                            >
                                Edit
                            </x-buttons.button-link>
                        </td>
                        {{-- BUTTON TOGGLES TO Sure??? FROM Delete ON CLICK TO CONFIRM DELETION --}}
                        <td>
                            @if($confirmingdelete===$guardian->user_id)
                                <x-buttons.button-link
                                    wire:click="delete({{ $guardian->user_id }})"
                                    class="border border-red-500 rounded px-2 bg-red-500 text-white hover:bg-red-600"
                                    key="{{ $guardian->user_id }}"
                                    title="Click to confirm deletion..."
                                >
                                    Confirm
                                </x-buttons.button-link>

                            @else
                                <x-buttons.button-link
                                    wire:click="delete({{ $guardian->user_id }})"
                                    class="border border-red-300 rounded px-2 bg-red-300 text-white hover:bg-red-600"
                                    key="{{ $guardian->user_id }}"
                                >
                                    Delete
                                </x-buttons.button-link>
                            @endif

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endif

    {{-- MODAL FORM --}}
    @if($editguardian)

        <div class="flex justify-end mt-6 text-blue-500">
            <x-buttons.button-link wire:click="closeForm" >Close Form</x-buttons.button-link>
        </div>

        <form wire:submit.prevent="save">

            <x-inputs.group label="Name" for="first" class="flex">
                <x-inputs.text label="" for="editguardianfirst" placeholder="First name..."/>
                <x-inputs.text label="" for="editguardianmiddle" placeholder=""/>
                <x-inputs.text label="" for="editguardianlast" placeholder="Last name..."/>
                {!! $similarnames !!}
            </x-inputs.group>

            <x-inputs.group label="Preferred Pronoun" for="pronoun_id">
                <x-inputs.select label="" :options="$pronouns" for="editguardianpronounid"
                                 currentvalue="{{ $editguardian->user_id ? $editguardian->person->pronoun_id : $editguardianpronounid}}"/>
            </x-inputs.group>

            <x-inputs.group label="Type" for="guardiantype_id">
                <x-inputs.select label="" :options="$guardiantypes" for="editguardiantypeid"
                                 currentvalue="{{ $editguardiantypeid }}"/>
            </x-inputs.group>

            <x-inputs.group label="Emails" for="primary_id">
                <x-inputs.email label="Primary email" for="editguardianemailprimary" placeholder=""/>
                <x-inputs.email label="Alternate email" for="editguardianemailalternate" placeholder=""/>
            </x-inputs.group>

            <x-inputs.group label="Phones" for="primary_id">
                <x-inputs.text label="Cell phone" for="editguardianphonemobile" placeholder=""/>
                <x-inputs.text label="Home phone" for="editguardianphonehome" placeholder=""/>
                <x-inputs.text label="Work phone" for="editguardianphonework" placeholder=""/>
            </x-inputs.group>

            <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
                <x-saves.save-message-without-button message="Guardian/Parent updated" trigger="guardian-saved"/>
                <x-saves.save-message-without-button message="Guardian/Parent update failed" trigger="guardian-failed" removed="true" />
                <x-buttons.button wire:click="save" type="submit">
                    Update {{ ucwords($student->person->fullname) }}</x-buttons.button>
            </footer>
        </form>
    @endif

</div>
