<div class="m-auto md:w-full" style="max-width: 1024px;">
    <div class="w-10/12 mx-auto border rounded p-2 mb-2 bg-yellow-50" >
        <!-- PAGE DEFINITION DETAIL -->
        <x-studentroster.pagedef displayhide="{{$displayhide}}" />
    </div>

    <!-- TABLE SECTION HEADERS -->
    <x-studentroster.students-header
        countstudents={{$countstudents}}
        :filter='$filter'
        :schools='$schools'
        :search='$search'
        showimportexport={{$showimportexport}}
    />

    @if($displayclassofserror)
        <div class="bg-white text-red-600 mt-2 px-2">
            No grades were found for {{ $school->name }}.  Please update your grades and first-year values using the
            <a href="{{ route('schools') }}" class="text-red-600 font-bold">Schools</a>
            link...
        </div>
    @endif

    <!-- PAGE TABLE AND [STUDENT DATA FORM] -->
    <div class="flex flex-col md:flex-row-reverse w-full overflow-x-hidden">
        {{-- STUDENT DETAILED INFORMATION TABBED --}}
        <x-studentroster.forms.tabbed
            :choralinstrumentation="$choralinstrumentation"
            :classofs="$classofs"
            :displayform="$displayform"
            :geostates="$geostates"
            :heights="$heights"
            :instrumentationbranch_id="$instrumentationbranch_id"
            :instrumentalinstrumentation="$instrumentalinstrumentation"
            :instrumentationbranches="$instrumentationbranches"
            :newinstrumentations="$newinstrumentations"
            :student="$student"
            :photo="$photo"
            :pronouns="$pronouns"
            :shirtsizes="$shirtsizes"
            :tabcontent="$tabcontent"
            :tab="$tab"
        />

        {{-- COLLAPSING TABLE --}}
        <x-studentroster.table :students="$students" :displayform="$displayform" :teacher="$teacher" />

        {{-- MODALS --}}

        {{-- INSTRUMENTATION MODAL --}}
        <div
            class="@if (! $showmodalinstrumentation) hidden @endif flex w-full h-full items-center justify-center fixed left-0 bottom-0  bg-gray-800 bg-opacity-90">
            <div class="bg-white rounded-lg ">
                <form wire:submit.prevent="storeInstrumentation" class="w-full">
                    <div class="flex flex-col items-start p-4">
                        <div class="flex items-center w-full border-b pb-4">
                            <div class="text-gray-900 font-medium text-lg">Add New Voice Part or Instrument</div>
                            <svg wire:click="closeModal"
                                 class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                            </svg>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700" for="title">
                                Type of...
                            </label>
                            <select wire:model="instrumentationbranch" name="instrumentationbranch_id"
                                    class="mt-2 text-sm sm-text-base pl-2 pr-4 round-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
                                    required
                            >
                                <option value="0">-- choose branch --</option>
                                @foreach($instrumentationbranches AS $instrumentationbranch)
                                    <option value="{{ $instrumentationbranch->id }}">{{ ucwords($instrumentationbranch->descr) }}</option>
                                @endforeach

                            </select>

                        </div>
                        <div class="py-4 border-b w-full mb-4">
                            <label class="block font-medium text-sm text-gray-700" for="title">
                                {{ $instrumentationbranch_id == 1 ? 'Voice Part' : 'Instrument' }}
                            </label>
                            <select wire:model="instrumentation_id" name="instrumentation_id"
                                    class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" required
                            >
                                @if($newinstrumentations->count() == 0)
                                    <option value="">-- choose branch first --</option>
                                @else
                                    <option value="0">-- choose {{ $instrumentationbranch_id == 1 ? 'voice part' : 'instrument' }} --</option>
                                @endif

                                @foreach($newinstrumentations AS $instrument)
                                    <option value="{{ $instrument->id }}">{{ ucwords($instrument->descr) }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="ml-auto">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    type="submit">Add {{ $instrumentationbranch_id == 1 ? 'Voice Part' : 'Instrument' }}
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
        </div>

        @if($showmodalguardian && $guardian)
            <x-studentroster.forms.modals.guardian
                :guardian="$guardian"
                :guardiantypes="$guardiantypes"
                :honorifics="$honorifics"
                :pronouns="$pronouns"
                :showmodalguardian="$showmodalguardian"
                :showmodalremoveguardian="$showmodalremoveguardian"
            />
        @endif

        {{-- CHICKEN TEST FOR GUARDIAN REMOVAL --}}
        @if($guardian && $guardian->user_id)
            <x-studentroster.forms.modals.chickenTestRemoveGuardian
                :showmodalremoveguardian="$showmodalremoveguardian"
                guardianfullname="{{ $guardian && $guardian->person ? $guardian->person->fullName : '' }}"
                studentfullname="{{ $student->person->fullName }}"
            />
        @endif

    </div>

</div>
