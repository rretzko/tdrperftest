<div>
    <div class="bg-white w-10/12 mx-auto border rounded p-2 mb-2">
        <div class="">
            <!-- PAGE DEFINITION HEADER -->
            <div class="flex justify-between "><!-- ml-4 mt-4 bg-white  -->
                <div class="text-lg leading-6 font-medium text-gray-900">
                    Students <i>(def.)</i>
                </div>
                <div class=" flex flex-shrink-0 ">
                    <!-- Heroicons small arrow-narrow-up -->
                    <button type="button" wire:click="$toggle('display_hide')"
                            class="text-gray-500 text-sm px-2 focus:outline-none ">
                        <!--  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 -->
                        {{ $display_hide ? 'Hide' : 'Display' }}
                    </button>
                </div>
            </div>

            <!-- PAGE DEFINITION DETAIL -->
            <div x-data="{show: @if($display_hide) true @else false @endif }">
                <div class=""
                     x-show.transition.duration.300ms.="show"
                >
                    <p class="mt-1 text-sm text-gray-500">
                        The Students page displays your roster of students, both past and present.
                    </p>
                    <p class="mt-1 text-sm text-gray-500">
                        Click on any student's name to display their detailed information.
                    </p>
                </div>
            </div>
        </div>
    </div> <!-- END OF PAGE DEFINITION -->

    <!-- PAGE HEADER -->
    <x-studentroster.school-selector :schools="$schools" schoolid={{$schoolid}}/>

    <x-studentroster.multi-column-directory  countstudents={{$countstudents}} :schools='$schools' :search='$search' :filter='$filter'/>

    <!-- PAGE TABLE AND [STUDENT DATA FORM] -->
    <div class="{{$displayform ? 'flex' : ''}} w-12/12">
        {{-- COLLAPSING TABLE --}}
        <x-studentroster.table :students="$students" :displayform="$displayform" :teacher="$teacher" />

        {{-- DISPLAY STUDENT DATA TABLE ON 'Edit' CLICK --}}
        <x-studentroster.form
          :addinstrument="$addinstrument"
          :choralinstrumentation="$choralinstrumentation"
          :classofs="$classofs"
          :displayform="$displayform"
          :geostates="$geostates"
          :guardians="$guardians"
          :heights="$heights"
          :instrumentationbranch_id="$instrumentationbranch_id"
          :instrumentalinstrumentation="$instrumentalinstrumentation"
          :instrumentationbranches="$instrumentationbranches"
          :newinstrumentations="$newinstrumentations"
          :photo='$photo'
          :pronouns="$pronouns"
          :shirtsizes="$shirtsizes"
          :showmodalinstrumentation="$showmodalinstrumentation"
          :showmodalremoveguardian="$showmodalremoveguardian"
          :student="$student"
      />
    </div>
{{-- LIVEWIREKIT MODAL START --}}
    <div
        class="@if (! $showmodal) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800 bg-opacity-90">
        <div class="bg-white rounded-lg w-1/2">
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

    {{-- GUARDIAN MODAL --}}
    <x-studentroster.forms.modals.guardian
        :guardian="$guardian"
        guardianfullname="{{ $guardian ? $guardian->person->fullName : '' }}"
        :guardiantypes="$guardiantypes"
        :honorifics="$honorifics"
        :pronouns="$pronouns"
        :showmodal="$showmodalguardian"
        :showmodalremoveguardian="$showmodalremoveguardian"
    />

{{-- LIVEWIRE KIT MODAL END --}}
</div>


