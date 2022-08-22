<div>
    <x-livewire-table-with-modal-forms >

        <x-slot name="title">
            {{ __('Library Information') }}
        </x-slot>

        <x-slot name="description">

            <x-sidebar-blurb blurb="Add or edit your library information here." />

        </x-slot>

        <x-slot name="table">

            {{-- Per Page, Bulk actions and ADD button --}}
            <div class="flex justify-end pr-6 space-x-2">
                <x-inputs.dropdowns.perpage />
                <x-inputs.dropdowns.bulkactions :selected="$selected" />
                <x-buttons.button-add toggle="showaddmodal" />
            </div>

            {{-- beginning of tailwindui table --}}
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                <div class="py-2 align-middle inline-block min-w sm:px-6 lg:px-8">
                    <div class="space-y-4 overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <div class="flex space-x-4">
                            <div class="flex">
                                <x-inputs.text wire:model.debounce.1s="search"
                                               for="search"
                                               label=""
                                               placeholder="Search ensemble name..."/>
                            </div>
                        <!-- {{-- SUPPRESS ADVANCED FILTERS
                            <div class="flex text-sm text-gray-600">
                                <x-buttons.button-link wire:click="$toggle('showfilters')">
                                    @if($showfilters) Hide @endif Advanced Filters @if(strlen($filterstring)) (current: "{{ $filterstring }}") @endif
                                </x-buttons.button-link>
                            </div>
--}} -->
                        </div>

                        <div>
<!-- {{--
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
--}} -->
                        </div>

                        <x-tables.surgetable class="w-11/12 ">
                            <x-slot name="head" >
                                <th class="w-2/12">Title</th>
                                <th class="w-2/12">Composer</th>
                                <th class="w-2/12">Arranger</th>
                                <th class="w-2/12">Style</th>
                                <th class="w-2/12">Count</th>

                            </x-slot>

                            <x-slot name="body" >

                                <tr>
                                    <th colspan="5" class="font-bold text-center" style="width:30rem;">Under Development but coming soon!!</th>
                                </tr>
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
            {{-- ADD/EDIT STUDENT --}}
            <div>
                @if($showeditmodal)
                    <x-modals.composition
                        showpublisherform="{{ $showpublisherform }}"
                        publisherselected="{{ $publisherselected }}"
                        :compositioncollectiontypes="$compositioncollectiontypes"
                        :compositiontypes="$compositiontypes"
                        :editcomposition="$editcomposition"
                        :geostates="$geostates"
                        :publisherslist="$publisherslist"
                    />
                @endif
            </div>

            {{-- DELETE ENSEMBLE --}}
            <div>
                @if($showDeleteModal)
                    <x-modals.delete :selected="$selected" objectname="ensemble" />
                @endif
            </div>



        </x-slot>


    </x-livewire-table-with-modal-forms>
</div>
