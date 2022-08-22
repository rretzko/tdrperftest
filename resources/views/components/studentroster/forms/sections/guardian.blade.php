@props([
'student',
])
<div class="md:grid md:grid-cols-3 md:gap-6 mt-3">
    <div class="md:col-span-1 px-2 py-2">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Parents & Guardians</h3>
            <p class="mt-1 text-sm text-gray-600">
                Parents and Guardians contact information for <b>{{ $student->person ? $student->person->fullName : 'new student'}}</b>
            </p>
        </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="guardians">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 white space-y-6 sm:p-6 bg-white">

                    {{-- GUARDIANS TABLE --}}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div>
                            <table class="ml-6 mt-4 mb-3 w-10/12">
                                <thead>
                                <tr class="border border-black bg-gray-100 ">
                                    <th class="pl-2 text-left w-10/12">Parent/Guardian{{ ($student->guardians()->count() > 1) ? 's' : '' }}</th>
                                    <td colspan="2" class="w-2/12 text-right">
                                        <a
                                            class="text-green-500 text-sm pr-1" wire:click.prevent="createGuardian"
                                            href="#">
                                            Add
                                        </a>
                                    </td>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($student->guardians AS $guardian)
                                    <tr class="border border-black bg-white">
                                        <td class="pl-2 text-left w-10/12">{{ $guardian->person->fullName }} ({{ $guardian->guardiantype()->descr }})</td>
                                        <td class="w-1/12">
                                            <a
                                                class="text-blue-500 text-xs" wire:click.prevent="editGuardian({{ $guardian->user_id }})"
                                                href="#">
                                                Edit
                                            </a>
                                        </td>
                                        <td class="w-1/12">
                                            <a
                                                class="text-red-800 text-xs pr-1" wire:click.prevent="removeGuardian({{ $guardian->user_id }})"
                                                href="#">
                                                Remove
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No parent/guardian found
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                            {{-- SAVED message --}}
                            <div class="font-italic bg-green-200 p-2"
                                 x-data="{show: false}"
                                 x-show.transition.duration.500ms="show"
                                 x-init="@this.on('saved-guardian',() => {
                                                setTimeout(() => { show = false; }, 2500 );
                                                show = true;
                                            })"
                            >
                                Parent/Guardian saved!
                            </div>

                            {{--  REMOVED message --}}
                            <div class="font-italic bg-red-200 p-2"
                                 x-data="{show: false}"
                                 x-show.transition.duration.500ms="show"
                                 x-init="@this.on('removed-guardian',() => {
                                                setTimeout(() => { show = false; }, 2500 );
                                                show = true;
                                            })"
                            >
                                Parent/Guardian removed.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>


</div>
