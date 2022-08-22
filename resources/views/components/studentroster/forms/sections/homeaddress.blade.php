@props([
'geostates',
'student',
])
<div class="md:grid md:grid-cols-3 md:gap-6 mt-3">
    <div class="md:col-span-1 px-2 py-2">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Home Address</h3>
            <p class="mt-1 text-sm text-gray-600">
                Home Address for <b>{{ $student->person ? $student->person->fullName : 'new student'}}</b>
            </p>
        </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="updateHomeaddress">
            <div class="shadow sm:rounded-md sm:overflow-hidden  ">
                {{-- ADDRESS --}}
                <div class="shadow overflow-hidden sm:rounded-md">

                    <div class="px-4 pt-5 sm:p-6 bg-white">
                        <div class="col-span-4 sm:col-span-4">
                            <x-inputs.text label="address" for="address01"/>
                        </div>
                        <div class="col-span-4 sm:col-span-4">
                            <x-inputs.text label="" for="address02"/>
                        </div>
                        <div class="col-span-4 sm:col-span-4">
                            <x-inputs.text label="city" for="city"/>
                        </div>
                        <div class="col-span-4 sm:col-span-4">
                            <x-inputs.select label="state" for="geostate_id" :options="$geostates" />
                        </div>
                        <div class="col-span-4 sm:col-span-4">
                            <x-inputs.text label="zip code" for="postalcode"/>
                        </div>

                        {{-- SAVE --}}
                        <x-saves.save-button-with-message message="Home address saved!"
                                                          trigger="saved-homeaddress"/>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
