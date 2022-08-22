@props([
'guardianfullname' => '',
'showmodalremoveguardian' => false,
'studentfullname' => '',
])

<div
    class="@if (! $showmodalremoveguardian) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800 bg-opacity-90">
    <div class="bg-white rounded-lg w-1/2">
        <form wire:submit.prevent="removeGuardianChickenTest" class="w-full">
            <div class="flex flex-col items-start p-4">
                <div class="flex items-center w-full border-b pb-4">
                    <div class="text-gray-900 font-medium text-lg">Remove Parent/Guardian?</div>
                    <svg wire:click="closeModal"
                         class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                    </svg>
                </div>
                <div class="w-full">
                    Do you <b><i>really</i></b> want to remove
                    <span class="text-lg font-bold">{{ $guardianfullname }}</span>
                    from {{ $studentfullname }}?
                </div>

                <div class="ml-auto">
                    <button wire:click="$set('removeguardianchickentest',1)"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">Yes
                    </button>
                    <button wire:click="$set('removeguardianchickentest',0)"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit">No
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
