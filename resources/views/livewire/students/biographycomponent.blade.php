<div>

    <form wire:submit.prevent="save">
        {{--  SYS.ID --}}
        <div class="text-sm mb-1">
            <label for="">Sys.Id.</label>
            <span>{{ $user->id }}</span>
        </div>

        {{-- USERNAME --}}
        <x-inputs.group label="UserName" for="" borderless>
            <x-inputs.text label="" for="username" defer/>
            <div class=" text-xs text-red-800 mt-1 px-2">
                If you change {{ $user->person->fullName ?: 'the new student'}}'s username,
                make sure you tell {{ $user->person ? $user->person->pronoun->object : 'them'}}.
            </div>
        </x-inputs.group>

        <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
            <x-saves.save-message-without-button message="Biography updated" trigger="biography-saved"/>
            <x-buttons.button wire:click="save" type="submit">Update {{ ucwords($user->person->fullname) }}</x-buttons.button>
        </footer>
    </form>

    {{-- IMAGE --}}
    <div>
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Photo
            </label>
            <div class="mt-1 flex items-center space-x-4 mb-1">
                <div class="relative inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                    @if($user->profile_photo_path ?: false)
                        <div>
                            <img class="absolute w-full h-full inset-0 object-cover"
                                 src="{{ '/storage/'.$user->profile_photo_path }}"/>
                        </div>
                    @else {{-- display default silhouette icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-12" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                              clip-rule="evenodd"/>
                    </svg>
                    @endif
                </div>

                @if($user->profile_photo_path)
                    <button class="text-sm px-3 py-2 bg-gray-200 text-gray-700 rounded"
                            wire:click.prevent="deleteProfilePhoto">Delete Profile Photo
                    </button>
                @endif
            </div>
        </div>

        {{-- IMAGE GET IMAGE --}}
        <div class="flex space-x-3">

            <div class="flex-col">
                <input type="file" wire:model="photo">

                @error('photo')
                <div class="error text-red-600">{{ $message }}</div> @enderror

                @if($photo)
                    {{-- PHOTO  PREVIEW --}}
                    <div>
                        <label class="mt-4 block text-sm font-medium text-gray-700">
                            @if($photo) {{ $photo->getClientOriginalName() }} @else 'Photo' @endif Preview: </label>
                        <div class="relative block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                            <img class="absolute w-full h-full inset-0 object-cover"
                                 src="{{ $photo->temporaryUrl() }}"/>

                        </div>
                    </div>
                @endif
            </div>

        </div>

        {{-- IMAGE SAVE --}}
        <div class="flex items-center justify-end">

        <span wire:loading wire:target="photo" class="mt-4 text-sm text-gray-500">
            Photo uploading...
        </span>
            <x-saves.save-message-without-button message="Photo deleted" trigger="profile-photo-removed" removed/>
            <x-saves.save-message-without-button message="Photo saved" trigger="profile-photo-saved"/>
            <x-buttons.button-link wire:click="savePhoto" class="bg-black text-white p-2 ml-1 rounded">Save Photo
            </x-buttons.button-link>

        </div>
    </div>

</div>
