@props([
'guardian' => false,
'guardiantypes' => [],
'honorifics' => [],
'pronouns' => [],
'showmodalguardian' => false,
'showmodalremoveguardian' => false,
])
<section
    class="@if (! $showmodalguardian) hidden @endif flex w-full h-full items-center justify-center fixed left-0 bottom-0 bg-gray-800 bg-opacity-90 overflow-y-auto">
    <div class="overflow-y-scroll bg-white rounded-lg" style="max-height: 90vh">

        <form wire:submit.prevent="" class="w-full">
            <div class="flex flex-col items-start p-4">
                <div class="flex items-center w-full border-b pb-4">
                    <div class="text-gray-900 font-medium text-lg">{{ $guardian && $guardian->user_id ? 'Edit' : 'Add' }} Parent/Guardian</div>
                    <svg wire:click="closeModal"
                         class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>

                {{-- NAMES --}}
                <div class="my-4 w-full">
                    <x-inputs.select class="mt-3" label="title" for="guardianhonorific_id" :options="$honorifics"  />
                    <x-inputs.text  for="guardianfirst" label="first name" initialfocus="1" />
                    <x-inputs.text  for="guardianmiddle" label="middle name" initialfocus="0" />
                    <x-inputs.text  for="guardianlast" label="last name" initialfocus="0" />
                    <x-inputs.select class="mt-3" label="preferred pronoun" for="guardianpronoun_id" :options="$pronouns"  />
                </div>

                {{-- PARENT/GUARDIAN TYPE  --}}
                <x-inputs.select class="mt-3" label="parent/guardian type" for="guardiantype_id" :options="$guardiantypes"  />

                {{-- EMAILS --}}
                <div class="my-4 w-full">
                    <x-inputs.email for="emailguardianprimary" label="primary email" initialfocus="0"/>
                    <x-inputs.email for="emailguardianalternate" label="alternate email" initialfocus="0"/>
                </div>

                {{-- PHONES --}}
                <div class="my-4 w-full">
                    <x-inputs.text for="phoneguardianmobile" label="cell phone" initialfocus="0"/>
                    <x-inputs.text for="phoneguardianhome" label="home phone" initialfocus="0"/>
                    <x-inputs.text for="phoneguardianwork" label="work phone" initialfocus="0"/>
                </div>

                <div class="ml-auto">
                    <button wire:click="{{ $guardian && $guardian->user_id ? 'updateGuardian' : 'storeGuardian'}}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold mb-2 py-2 px-4 rounded"
                            type="submit">
                            {{ $guardian && $guardian->user_id ? 'Update' : 'Add' }} Parent/Guardian
                    </button>
                    <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                            wire:click="closeModal"
                            type="button"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </form>
    </div>

</section>
