<div>
    @if($student && $student->user_id) Profile for: {{ $student->person->fullName }} @else New Student Profile @endif

    <form wire:submit.prevent="save">

        <x-inputs.group label="Name" for="first" class="flex">
            <x-inputs.text label="" for="first" placeholder="First name..." required="true"/>
            <x-inputs.text label="" for="middle" placeholder=""/>
            <x-inputs.text label="" for="last" placeholder="Last name..." required="true"/>
        </x-inputs.group>

        <x-inputs.group label="Grade/Class of" for="classof">
            <select name="classof" wire:model.defer="classof">
                @foreach($classofs AS $key => $classof)
                    <option value="{{ $key }}"

                    >{{ $classof }}</option>
                @endforeach
            </select>
        </x-inputs.group>

        <x-inputs.group label="Preferred Pronoun" for="pronoun_id">
            <x-inputs.select label="" :options="$pronouns" for="pronoun_id"
                             currentvalue="{{ ($student && $student->user_id) ? $student->pronoun_id : '' }}"/>
        </x-inputs.group>

        {{-- EMERGENCY CONTACTS FOR NEWLY ADDED STUDENTS--}}
        <div @if(! $student) style="border-top: 1px solid rgba(255,0,0,.3); border-bottom: 1px solid rgba(255,0,0,.3);" @endif>
            @if(! $student)
                <div style="padding-top: .25rem;">
                    <header style="color: darkred;">Emergency Contact Information</header>
                </div>

                <div class="flex mb-2 relative pt-2">

                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700 pt-2" style="width: 8rem;">
                        Student Email
                    </label>

                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input wire:model="email" class="rounded" type="email" id="email" value="" required/>

                        @error('email')
                        <p class="mt-2 text-sm text-red-600" id="email-error">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="flex mb-2 relative pt-2">

                    <label for="parent-first" class="block text-sm font-medium leading-5 text-gray-700 pt-2"
                           style="width: 8rem;">
                        Parent Name
                    </label>

                    <div id="parent-names" class="flex flex-col">
                        <div class="mt-1 relative rounded-md">
                            <input wire:model.lazy="parentfirst" class="rounded" type="text" id="parentfirst" value=""
                                   placeholder="First" required/>

                            @error('parentfirst')
                            <p class="mt-2 text-sm text-red-600" id="parentfirst-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="mt-1 relative rounded-md">
                            <input wire:model.lazy="parentlast" class="rounded" type="text" id="parentlast" value=""
                                   placeholder="Last" required/>

                            @error('parentlast')
                            <p class="mt-2 text-sm text-red-600" id="parentlast-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex mb-2 relative pt-2">

                    <label for="parent-email" class="block text-sm font-medium leading-5 text-gray-700 pt-2"
                           style="width: 8rem;">
                        Parent Email
                    </label>

                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input wire:model.lazy="parentemail" class="rounded" type="email" id="parentemail" value="" required/>

                        @error('parentemail')
                        <p class="mt-2 text-sm text-red-600" id="parentemail-error">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="flex mb-2 relative pt-2">
                    <label for="parent-cell" class="block text-sm font-medium leading-5 text-gray-700 pt-2"
                           style="width: 8rem;">Parent Cell</label>

                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input wire:model="parentcell" class="rounded" type="text" id="parentcell" value="" required/>

                        @error('parentcell')
                        <p class="mt-2 text-sm text-red-600" id="parentcell-error">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            @endif
        </div>

        {{-- EVENT-OPTIONAL INFORMATION --}}
        <x-inputs.group label="Height" for="height">
            <x-inputs.select label="" :options="$heights" for="height" currentvalue="{{ ($student && $student->user_id) ? $student->height : '' }}"/>
        </x-inputs.group>

        <x-inputs.group label="Shirt size" for="shirtsize">
            <x-inputs.select label="" :options="$shirtsizes" for="shirtsize_id"
                             currentvalue="{{ ($student && $student->user_id) ? $student->shirtsize_id : '' }}"/>
        </x-inputs.group>

        <x-inputs.group label="Birthday" for="birthday">
            <x-inputs.date label="" for="birthday"/>
        </x-inputs.group>

        <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
            <x-saves.save-message-without-button message="Profile updated" trigger="profile-saved"/>
            <x-buttons.button type="submit">Update
                @if($student && $student->user_id)
                    {{ ucwords($student->person->fullname) }}
                @else
                    Student
                @endif
            </x-buttons.button>
        </footer>
    </form>
</div>
