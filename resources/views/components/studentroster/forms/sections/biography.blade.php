@props([
'student',
'photo',
])

<div class="md:grid md:grid-cols-3 md:gap-6 mt-3">
    <div class="md:col-span-1 px-2 py-2">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Biography</h3>
            <p class="mt-1 text-sm text-gray-600">
                Basic biographical information about: <br /><b>{{ $student->person ? $student->person->fullName : 'new student'}}</b>
            </p>
        </div>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="updateBiography">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                    {{--  SYS.ID --}}
                    <div class="grid grid-cols-3 gap-6">
                        Sys.Id. {{$student->user_id}}
                    </div>

                    {{-- USERNAME --}}
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <x-inputs.text label="Username" for="username"/>
                            <div class=" text-xs text-red-800 mt-1 px-2">If you change {{ $student->person ? $student->person->first : 'the new student'}}'s username, make sure you tell {{ $student->person ? $student->person->pronoun->object : 'them'}}.</div>
                        </div>
                    </div>

                    {{-- PHOTO --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Photo
                        </label>
                        <div class="mt-1 flex items-center space-x-4">
                            <div class="relative inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @if($student->person ? $student->person->user->profile_photo_path : false)
                                    <div>
                                        <img class="absolute w-full h-full inset-0 object-cover" src="{{ '/storage/'.$student->person->user->profile_photo_path }}" />
                                    </div>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-12" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>

                            @if($student->person && $student->person->user->profile_photo_path)
                                <button class="text-sm px-3 py-2 bg-gray-200 text-gray-700 rounded" wire:click.prevent="deleteProfilePhoto">Delete Profile Photo</button>
                            @endif
                        </div>
                    </div>

                    {{-- PHOTO --}}
                    <div class="flex space-x-3">

                        <!-- <form wire:submit.prevent="savePhoto"> -->

                            <div class="flex-col">
                                <input type="file" wire:model="photo">

                                @error('photo')<div class="error text-red-600">{{ $message }}</div> @enderror

                                @if($photo)
                                    {{-- PHOTO  PREVIEW --}}
                                    <div>
                                        <label class="mt-4 block text-sm font-medium text-gray-700">Photo Preview: </label>
                                        <div class="relative block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                            <img class="absolute w-full h-full inset-0 object-cover" src="{{ $photo->temporaryUrl() }}" />
                                        </div>
                                    </div>
                                @endif
                            </div>

                        <!-- </form> -->
                    </div>

                    {{-- SAVE --}}
                    <div class="flex items-center justify-end">
                        <span wire:loading wire:target="photo" class="mt-4 text-sm text-gray-500">
                            Photo uploading...
                        </span>
                        <x-saves.save-button-with-message message="Biography information saved!"
                                                        trigger="saved-biography"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
