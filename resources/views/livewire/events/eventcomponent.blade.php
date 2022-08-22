<div>
    <div>
        <x-livewire-table-with-modal-forms>

            <x-slot name="title">
                {{ __('Audition Information') }}
            </x-slot>

            <x-slot name="description">

                <x-sidebar-blurb blurb="Add or edit your audition information here."/>

                <x-sidebar-blurb blurb="Auditions..." />

            </x-slot>

            <x-slot name="table">
                {{-- Events table --}}
                {{-- Per Page and Bulk actions are commented out but left for future usage --}}
                <div class="flex justify-between pr-6 space-x-2">
                    <!-- <x-inputs.dropdowns.perpage />
                    <x-inputs.dropdowns.bulkactions :selected="$selected" /> -->
                    <div
                        class="mb-2 @if($emailsent) p-1 w-10/12 bg-green-50 text-green-700 border border-black rounded @endif">
                        {{ $emailsent }}
                    </div>

                    <x-buttons.button-add toggle="showaddmodal"/>
                </div>

                {{-- beginning of tailwindui table --}}

                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                    <div class="py-2 align-middle inline-block min-w sm:px-6 lg:px-8">
                        <div class="space-y-4 overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        {{-- SEARCH is commented out but left for future usage --}}
                        <!-- {{-- <div class="flex space-x-4">
                                <!-- {{-- <div class="flex">
                                    <x-inputs.text wire:model.debounce.1s="search"
                                                   for="search"
                                                   label=""
                                                   placeholder="Search organization name..."/>
                                </div>

                            <div class="flex text-sm text-gray-600">
                                <x-buttons.button-link wire:click="$toggle('showfilters')">
                                    @if($showfilters) Hide @endif Advanced Filters @if(strlen($filterstring)) (current: "{{ $filterstring }}") @endif
                                </x-buttons.button-link>
                            </div>

                            </div>

                            <div>
                                @if($showfilters)
                                    <div class="bg-gray-300 p-4 rounded shadow-inner flex relative">

                                        <div class="2-1/2 pr-2 space-y-4">
                                            <div class=" border border-black p-2 bg-gray-200 text-sm" id="advisory">
                                                Please note: Filters are applied against the selected population
                                                (Current/Alum/All) and will temporarily remove pagination.
                                            </div>

                                            <x-inputs.group inline for="filter-first" label="First Name">

                                                <x-inputs.text id="filter-first" for="filters.first" label="" placeholder="Seach by first name..."/>
                                            </x-inputs.group>

                                            <x-inputs.group inline for="filter-instrumentations" label="Voice Parts">
                                                <x-inputs.select id="filter-instrumentations"
                                                                 for="filters.instrumentation_id"
                                                                 label=""
                                                                 :options="$sortedinstrumentations"
                                                                 placeholder="Select Voice Part..."
                                                                 immediate
                                                >

                                                </x-inputs.select>
                                            </x-inputs.group>

                                            <x-inputs.group inline for="filter-classofs" label="Classes">
                                                <x-inputs.select id="filter-classofs"
                                                                 for="filters.classof" label=""
                                                                 :options="$sortedclassofs"
                                                                 placeholder="Select Class..."
                                                                 immediate
                                                >

                                                </x-inputs.select>
                                            </x-inputs.group>

                                            <x-buttons.button-link wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</x-buttons.button-link>
                                        </div>

                                    </div>
                                @endif
                            </div> --}} -->

                            <x-tables.surgetable class="w-full">
                                <x-slot name="head">

                                    <th class="px-2" title="Event"><span class="">Audition</span></th>
                                    <th class="px-2" title="Open"><span class="">Open</span></th>
                                    <th class="px-2" title="Closed"><span class="">Closed</span></th>

                                </x-slot>

                                <x-slot name="body">

                                {{-- Commented out and left for future usage --}}
                                <!-- {{--
                                    @if($selectpage)

                                        <x-tables.row class="bg-gray-200" wire:key="row-message">
                                            <x-tables.cell colspan="8">
                                                @unless($selectall)
                                                    <div>You have selected <strong>{{ count($selected) }}</strong> organizations, do
                                                        you want to select all <strong>{{ $organizations->count() }}</strong>?
                                                        <x-buttons.button-link wire:click="selectAll"
                                                                               class="ml-1 text-blue-600">Select All
                                                        </x-buttons.button-link>
                                                    </div>
                                                @else
                                                    <span>You have selected all <strong>{{ $organizations->count() }}</strong>
                                                    organizations.</span>
                                                @endunless
                                            </x-tables.cell>
                                        </x-tables.row>
                                    @endif
                                    --}} -->

                                    @forelse($events AS $event)
                                        <x-tables.row
                                            wire:loading.class.delay="opacity-50"
                                            style=""
                                            wire:key="row-{{ $event->id }}"
                                            altcolor="{{$loop->even}}"
                                        >
                                            <x-tables.cell>
                                                <a href="
                                                    @if($event->dates('results_release') === 'not found')
                                                        {{ route('registrants.index',['eventversion' => $event]) }}
                                                    @else
                                                        {{ route('auditionresults.index',['eventversion' => $event]) }}
                                                    @endif "
                                                   class="text-blue-700 hover:underline hover:text-red-700"
                                                >
                                                    {{ $event->name }}
                                                </a>
                                            </x-tables.cell>

                                            <x-tables.cell>
                                                {{ $event->dates('membership_open') }}
                                            </x-tables.cell>

                                            <x-tables.cell>
                                                {{ $event->dates('membership_close') }}
                                            </x-tables.cell>
                                        </x-tables.row>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-gray-500 text-center">
                                                No Events found @if(strlen($this->search)) with search
                                                value: {{ $this->search }}@endif.
                                            </td>
                                        </tr>

                                @endforelse
                                <!-- {{-- SUPPRESS PAGINATION
                                <div class="mb-2">
                                    {{$ensembles->count() ? $ensembles->links() : ''}}
                                </div>
--}} -->
                                </x-slot>

                            </x-tables.surgetable>

                        <!-- {{-- SUPPRESS PAGINATION
                        <div class="mb-2">
                            @if($ensembles->count() > 5)
                                {{$ensembles->count() ? '$ensembles->links()' : ''}}
                            @endif
                        </div>
--}} -->
                        </div>
                    </div>
                </div>

                {{-- MODALS --}}
                {{-- ADD/EDIT EVENT --}}
                <div>
                    @if($showeditmodal)
                        <x-modals.membership
                            request="true"
                            membershipid="{{$editorganizationmembershipid}}"
                            :organization="$editorganization"
                            :membershiptypes="$membershiptypes"
                        />
                    @endif
                </div>

                {{-- DELETE ENSEMBLE --}}
                <div>
                @if($showDeleteModal)
                    <!-- {{-- <x-modals.delete :selected="$selected" objectname="ensemble" /> --}} -->
                    @endif
                </div>

            </x-slot>

            <x-slot name="actions">

            </x-slot>

        </x-livewire-table-with-modal-forms>
    </div>

</div>

