@props([
'classofs',
'heights',
'pronouns',
'shirtsizes',
'student',
])
<div class="md:grid md:grid-cols-3 md:gap-6 mt-3">

    <div class="md:col-span-1 px-2 py-2">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Personal</h3>
            <p class="mt-1 text-sm text-gray-600">
                Basic identification information about <b>{{ $student && $student->person ? $student->person->fullName : 'new student'}}</b>
            </p>
        </div>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="updateProfile">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                    {{-- NAMES --}}
                    <div class="flex flex-col md:grid md:grid-cols-6 md:gap-6">
                        <div class="col-span-2 sm:col-span-2">
                            <x-inputs.text label="First name" for="first"/>
                        </div>

                        <div class="col-span-2 sm:col-span-2">
                            <x-inputs.text label="Middle name" for="middle"/>
                        </div>

                        <div class="col-span-2 sm:col-span-2">
                            <x-inputs.text label="Last name" for="last"/>
                        </div>

                        {{-- CLASSOFS --}}
                        <div class="col-span-6 sm:col-span-4">
                            <x-inputs.select :options="$classofs"
                                 label="Grade/Class of" for="classof"
                                 name="classof"
                                 id="classof"/>
                        </div>

                        {{-- PRONOUN --}}
                        <div class="col-span-6 sm:col-span-4">
                            <x-inputs.select :options="$pronouns"
                                 label="preferred pronoun" for="pronoun_id"
                                 name="pronoun_id"
                                 id="pronoun_id"/>
                        </div>

                        {{-- HEIGHT --}}
                        <div class="col-span-6 sm:col-span-4">
                            <x-inputs.select :options="$heights" label="Height in inches"
                                 for="height" name="height" id="height"/>
                        </div>

                        {{-- SHIRTSIZE --}}
                        <div class="col-span-6 sm:col-span-4">
                            <x-inputs.select :options="$shirtsizes"
                                 label="shirt size" for="shirtsize_id"
                                 name="shirtsize_id"
                                 id="shirtsize_id"/>
                        </div>

                        {{-- BIRTHDAY --}}
                        <div class="col-span-6 sm:col-span-4">
                            <x-inputs.date wire:select.defer="birthday" label="birthday"
                               for="birthday"
                               name="birthday" id="birthday"/>
                        </div>

                    </div>

                    {{-- SAVE --}}
                    <x-saves.save-button-with-message message="Personal information saved!"
                          trigger="saved-personal"/>

                </div>
            </div>
        </form>
    </div>
</div>
