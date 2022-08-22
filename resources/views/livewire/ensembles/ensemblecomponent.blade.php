<div>
    <x-livewire-table-with-modal-forms >

        <x-slot name="title">
            {{ __('Ensemble Information') }}
        </x-slot>

        <x-slot name="description">

            <x-sidebar-blurb blurb="Add or edit your ensemble information here." />

            <x-sidebar-blurb blurb="Click a column header to sort the table rows." />

            <x-sidebar-blurb blurb="Click the '<b>Mbrs</b>' (purple) button to add/edit individual ensemble members." />

            <x-sidebar-blurb blurb="Click the '<b>Edit</b>' (blue) button to display an individual ensemble's detailed information." />

            <x-sidebar-blurb blurb="Click the '<b>Assets</b>' (green) button to add/edit ensemble assets (ex. folders, uniforms, etc.)." />

        </x-slot>

        <x-slot name="table">
            {{-- Ensemble table --}}
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
                        </div>

                        <x-tables.surgetable class="w-full ">
                            <x-slot name="head" >

                                <x-tables.heading >
                                    <x-inputs.checkbox class="pr-0 w-4" for="selectpage" label=""/>
                                </x-tables.heading>

                                <x-tables.heading wire:click.prevent="sortField('name')"
                                                  sortable
                                                  direction="asc"
                                                  :direction="$sortfield === 'name' ? $sortdirection : null"
                                >
                                    Name
                                </x-tables.heading>

                                <x-tables.heading wire:click.prevent="sortField('type')"
                                                  sortable
                                                  direction="asc"
                                                  :direction="$sortfield === 'classof' ? $sortdirection : null"
                                >
                                    Type
                                </x-tables.heading>

                                <x-tables.heading wire:click.prevent="sortField('startyear')"
                                                  sortable
                                                  direction="asc"
                                                  :direction="$sortfield === 'instrumentation' ? $sortdirection : null"
                                >
                                    Since
                                </x-tables.heading>

                                <x-tables.heading wire:click.prevent="sortField('members')"
                                                  sortable
                                                  direction="asc"
                                                  :direction="$sortfield === 'instrumentation' ? $sortdirection : null"
                                >
                                    Members
                                </x-tables.heading>

                                <th><span class="sr-only">Edit</span></th>
                                <th><span class="sr-only">Assets</span></th>

                            </x-slot>

                            <x-slot name="body" >

                                @if($selectpage)
                                    <x-tables.row class="bg-gray-200" wire:key="row-message">
                                        <x-tables.cell colspan="7">
                                            @unless($selectall)
                                                <div>You have selected <strong>{{ count($selected) }}</strong> ensembles, do
                                                    you want to select all <strong>{{ $ensembles->count() }}</strong>?
                                                    <x-buttons.button-link wire:click="selectAll"
                                                                           class="ml-1 text-blue-600">Select All
                                                    </x-buttons.button-link>
                                                </div>
                                            @else
                                                <span>You have selected all <strong>{{ $ensembles->count() }}</strong>
                                                    ensembles.</span>
                                            @endunless
                                        </x-tables.cell>
                                    </x-tables.row>
                                @endif

                                @forelse($ensembles AS $ensemble)
                                    <x-tables.row wire:loading.class.delay="opacity-50" altcolor="{{$loop->iteration % 2}}" wire:key="row-{{ $ensemble->id }}">

                                        <x-tables.cell>
                                            <x-inputs.checkbox value="{{ $ensemble->id }}" class="" for="selected" label="" />
                                        </x-tables.cell>

                                        <x-tables.cell>
                                            {{ $ensemble->name }}
                                        </x-tables.cell>
                                        <x-tables.cell>
                                            {{ $ensemble->ensembletype->descr }}
                                        </x-tables.cell>

                                        <x-tables.cell>
                                            {{ $ensemble->startyear }}
                                        </x-tables.cell>

                                        <x-tables.cell class="text-center">
                                            <a class='border border-indigo-600 rounded px-2 bg-indigo-400 text-white hover:bg-blue-600 text-xs py-0.5'
                                               href="{{ route('ensemblemembers.index', ['ensemble' => $ensemble]) }}"
                                               title="Click to add/edit {{ $ensemble->name }} members"
                                            >
                                                {{ $ensemble->ensemblemembers->count() }} Mbr{{ ($ensemble->ensemblemembers->count() !== 1) ? 's' : '' }}
                                            </a>
                                        </x-tables.cell>

                                        <x-tables.cell>
                                            <x-buttons.button-link
                                                wire:click.defer="edit({{ $ensemble->id }})"
                                                class="border border-blue-500 rounded px-2 bg-blue-400 text-white hover:bg-blue-600"
                                            >
                                                Edit
                                            </x-buttons.button-link>
                                        </x-tables.cell>

                                        <x-tables.cell>
                                            <a href="{{ route('ensemble.assets.index', ['ensemble' => $ensemble]) }}"
                                               class="border border-green-500 rounded px-2 bg-green-600 text-white hover:bg-green-400"
                                               title="Click to edit {{ $ensemble->name }} assets"
                                            >
                                                Assets
                                            </a>

                                        </x-tables.cell>

                                    </x-tables.row>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-gray-500 text-center">
                                            No Ensemble found @if(strlen($this->search)) with search value: {{ $this->search }}@endif.
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
            {{-- ADD/EDIT STUDENT --}}
            <div>
                @if($showeditmodal)
                    <x-modals.ensemble :ensemble="$editensemble" :ensembletypes="$ensembletypes" :years="$years" />
                @endif
            </div>

            {{-- DELETE ENSEMBLE --}}
            <div>
                @if($showDeleteModal)
                    <x-modals.delete :selected="$selected" objectname="ensemble" />
                @endif
            </div>



        </x-slot>

        <x-slot name="actions" >


        </x-slot>

    </x-livewire-table-with-modal-forms>
</div>


