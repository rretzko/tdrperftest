@props([
'student',
'tab',
])
<div class="md:grid md:grid-cols-3 md:gap-6 mt-3">
    <div class="md:col-span-1 px-2 py-2">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Contacts</h3>
            <p class="mt-1 text-sm text-gray-600">
                Email and phone contact information for <b>{{ $student->person ? $student->person->fullName : 'new student'}}</b>
            </p>
        </div>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2 bg-white">
        <form wire:submit.prevent="updateCommunication">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white-50 space-y-6 sm:p-6">

                    {{-- EMAILS --}}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        {{-- EMAILS:SCHOOL --}}
                        <div class="px-4 pt-5 sm:p-6">
                            <div class="col-span-4 sm:col-span-4">
                                <x-inputs.email label="school email" for="emailschool"/>
                            </div>
                        </div>
                        {{-- EMAILS: PERSONAL --}}
                        <div class="px-4 sm:p-6">
                            <div class="col-span-4 sm:col-span-4">
                                <x-inputs.email label="personal email" for="emailpersonal"/>
                            </div>
                        </div>
                    </div>

                    {{-- PHONES --}}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        {{-- PHONES:MOBILE --}}
                        <div class="px-4 py-5 sm:p-6">
                            <div class="col-span-4 sm:col-span-4">
                                <x-inputs.text label="cell phone" for="phonemobile"/>
                            </div>
                        </div>
                        {{-- PHONES:HOME --}}
                        <div class="px-4 py-5 sm:p-6">
                            <div class="col-span-4 sm:col-span-4">
                                <x-inputs.text label="home phone" for="phonehome"/>
                            </div>
                        </div>
                    </div>

                    {{-- SAVE --}}
                    <x-saves.save-button-with-message message="Contact information saved!"
                                                      trigger="saved-communication"/>

                </div>
            </div>
        </form>
    </div>
</div>
