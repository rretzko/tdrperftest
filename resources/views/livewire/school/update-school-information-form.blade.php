<div>
    <x-table-with-modal-form >

        <x-slot name="title">
            {{ __('School and Studio Information') }}
        </x-slot>

        <x-slot name="description" >

            <x-sidebar-blurb blurb="Add or edit your school and studio information here." />

            <x-sidebar-blurb blurb="Note that a Studio has been created for you to store information which may be related to your
                    personal studio and independent of any particular school." />

        </x-slot>

        <x-slot name="table">
            {{-- Studio + Schools table --}}
            {{-- Per Page, Bulk actions and ADD button --}}
            <div class="flex justify-end pr-6 space-x-2">
                <x-inputs.dropdowns.perpage />
                <x-inputs.dropdowns.bulkactions :selected="$selected" />
                <x-buttons.button-add toggle="showAddModal" />
            </div>


            {{-- beginning of tailwindui table --}}
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                <div class="py-2 align-middle inline-block min-w sm:px-6 lg:px-8">
                    <div class="space-y-4 overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="w-1/3">
                            <x-inputs.text wire:model="search" for="search" label="" placeholder="Search School name..."/>
                        </div>

                        <x-tables.surgetable class="w-full ">
                                <x-slot name="head" >

                                    <x-tables.heading >
                                        <x-inputs.checkbox class="pr-0 w-4" for="selectpage" label=""/>
                                    </x-tables.heading>
                                    <x-tables.heading wire:click="sortField('name')" sortable direction="asc" :direction="$sortfield === 'name' ? $sortdirection : null" >Name</x-tables.heading>
                                    <x-tables.heading wire:click="sortField('location')" sortable direction="asc" :direction="$sortfield === 'location' ? $sortdirection : null" >Location</x-tables.heading>
                                    <x-tables.heading wire:click="sortField('tenure')" sortable direction="asc" :direction="$sortfield === 'tenure' ? $sortdirection : null" >Tenure</x-tables.heading>
                                    <th><span class="sr-only">Edit</span></th>

                                </x-slot>

                            <x-slot name="body" >

                                @if($selectpage)
                                    <x-tables.row class="bg-gray-200" wire:key="row-message">
                                        <x-tables.cell colspan="5">
                                            @unless($selectall)
                                                <div>You have selected <strong>{{ count($selected) }}</strong> schools, do
                                                    you want to select all <strong>{{ $schools->total() }}</strong>?
                                                    <x-buttons.button-link wire:click="selectAll"
                                                                           class="ml-1 text-blue-600">Select All
                                                    </x-buttons.button-link>
                                                </div>
                                            @else
                                                <span>You have selected all <strong>{{ $schools->total() }}</strong>
                                                    schools.</span>
                                            @endunless
                                        </x-tables.cell>
                                    </x-tables.row>
                                @endif

                                @forelse($schools AS $school)
                                    <x-tables.row wire:loading.class.delay="opacity-50" altcolor="{{$loop->iteration % 2}}" wire:key="row-{{ $school->id }}">
                                        <x-tables.cell>
                                            <x-inputs.checkbox value="{{ $school->id }}" class="" for="selected" label="" />
                                        </x-tables.cell>
                                        <x-tables.cell>
                                            {{ $school->name }}
                                        </x-tables.cell>
                                        <x-tables.cell>
                                            {!! $school->mailingAddress !!}
                                        </x-tables.cell>
                                        <x-tables.cell>
                                            {{ auth()->user()->person->teacher->tenureYearsAtSchool($school->id) }}
                                        </x-tables.cell>
                                        <x-tables.cell>
                                            @if(strpos($school->name, 'Studio'))
                                                <span class="text-blue-700" title="Coming soon: Keep records for your own studio!">DEV</span>
                                            @else
                                                <a href="#"
                                                   wire:click.defer="edit({{ $school->id }})"
                                                   class="border border-blue-500 rounded px-2 bg-blue-400 text-white hover:bg-blue-600">
                                                    Edit
                                                </a>
                                            @endif
                                        </x-tables.cell>
                                    </x-tables.row>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-gray-500 text-center">
                                            No School found @if(strlen($this->search)) with search value: {{ $this->search }}@endif.
                                        </td>
                                    </tr>
                                @endforelse
                            </x-slot>

                        </x-tables.surgetable>
                        {{$schools->count() ? $schools->links() : ''}}
                    </div>
                </div>
            </div>
            <script>
                function chickenTest($school)
                {
                    return confirm('Do you really want to remove @if($school){{ $school->name }}  @endif from your list of schools?');
                }
            </script>

            <!-- Edit Modal -->
            <x-modals.dialog wire:model="showEditModal" >

                <x-slot name="title">Schools</x-slot>

                <x-slot name="content">
                    {{-- LOCATION --}}
                    <div class="section_descr text-sm bg-gray-200 mb-2 p-2 border border-gray-400 rounded">
                        <p>
                            TheDirectorsRoom.com uses school location information for ALL teachers at this
                            school. <br />
                            Please only update generic school location information and do NOT include
                            location information which is specific to your location (ex. room number) at the school.
                        </p>
                    </div>
                    <x-inputs.text wire:model.defer="name" label="School name" for="name" name="name" id="name" />
                    <x-inputs.text wire:model.defer="address0" label="address" for="address0" name="address0" id="address0" />
                    <x-inputs.text wire:model.defer="address1" label="" for="address1" name="address1" id="address1" />
                    <x-inputs.text wire:model.defer="city" label="city" for="city" name="city" id="city" />
                    <x-inputs.select wire:select.defer="geostate_id" :options="$options" label="state" for="geostate_id" name="geostate_id" id="geostate_id" />
                    <x-inputs.text wire:model.defer="postalcode" label="postalcode" for="postalcode" name="postalcode" id="postalcode" />

                    {{-- TENURE: START/END YEARS --}}
                    <section class="mt-4">
                        <div class="section_descr text-sm bg-gray-200 mb-2 p-2 border border-gray-400 rounded">
                            <p>
                                Please describe your tenure at {{ $name }}. <br />
                                Leave 'End Year' blank if still working there.
                            </p>
                        </div>
                        <x-inputs.select wire:select.defer="startyear" :options="$startyears" label="start year" for="startyear" name="startyear" id="startyear" />
                        <x-inputs.select wire:select.defer="endyear" :options="$endyears" label="end year" for="endyear" name="endyear" id="endyear" />
                    </section>

                    {{-- GRADES --}}
                    <section class="mt-4">
                        <div class="section_descr text-sm bg-gray-200 mb-2 p-2 border border-gray-400 rounded">
                            <p>
                                Please select the grades you teach at {{ $name }}.
                            </p>
                        </div>
                        <div class="section_values flex flex-wrap ">
                            @foreach($gradetypes AS $key => $value)
                                <div class="ml-2">
                                    <label>{{ $value }}</label>
                                    <input type="checkbox"
                                           wire:click="updateGrades({{ $key }})"
                                           name="grades[{{ $key }}]"
                                           id="grades[{{ $key }}]"
                                           @if($grades[$key]) CHECKED @endif
                                           value="1"
                                    />
                                </div>
                            @endforeach
                            <!-- {{-- <x-inputs.checkbox selected="1" label="grade 1" for="grades[1]" name="grades[1]" id="grades[1]" /> --}} -->
                        </div>
                    </section>

                </x-slot>

                <x-slot name="footer">
                    <x-buttons.secondary wire:click="$set('showEditModal',false)" >Cancel</x-buttons.secondary>
                    <x-buttons.button wire:click="save" >Save</x-buttons.button>
                </x-slot>
            </x-modals.dialog>

            <!-- Add Modal -->
            <x-modals.dialog wire:model="showAddModal" >

                <x-slot name="title">Add a School</x-slot>

                <x-slot name="content">
                    {{-- LOCATION --}}
                    @if($schoolid)
                        <div>
                            <div class="font-bold">{{ $name }} </div>
                            <div>{!! $mailingaddress !!}</div>
                        </div>
                    @else
                        <x-inputs.text wire:model="name" label="School name" for="name" name="name" id="name" required="required" />
                        <div>
                            @if(count($searchresults))
                                <ul class="m-3 text-sm">
                                    @foreach($searchresults AS $key => $value)
                                        <li>
                                            <div wire:click='loadSchool({{ $key }})' class="cursor-pointer">
                                                {{ $value }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <x-inputs.text wire:model.defer="address01" label="address" for="address01" name="address01" id="address01" />
                        <x-inputs.text wire:model.defer="address02" label="" for="address02" name="address02" id="address02" />
                        <x-inputs.text wire:model.defer="city" label="city" for="city" name="city" id="city" />
                        <x-inputs.select wire:select.defer="geostate_id" :options="$options" label="state" for="geostate_id" name="geostate_id" id="geostate_id" />
                        <x-inputs.text wire:model.defer="postalcode" label="postalcode" for="postalcode" name="postalcode" id="postalcode" />
                    @endif

                    {{-- TENURE: START/END YEARS --}}
                    <section class="mt-4">
                        <div class="section_descr text-sm bg-gray-200 mb-2 p-2 border border-gray-400 rounded">
                            <p>
                                Please describe your tenure at {{ $name }}. <br />
                                Leave 'End Year' blank if still working there.
                            </p>
                        </div>
                        <x-inputs.select wire:select.defer="startyear" :options="$startyears" label="start year" for="startyear" name="startyear" id="startyear" />
                        <x-inputs.select wire:select.defer="endyear" :options="$endyears" label="end year" for="endyear" name="endyear" id="endyear" />
                    </section>

                    {{-- GRADES --}}
                    <section class="mt-4 space-y-2">
                        <div class="section_descr text-sm bg-gray-200 p-2 border border-gray-400 rounded">
                            <p>
                                Please select the grades you teach at {{ $name }}.
                            </p>
                        </div>
                        <div class="section_values flex flex-wrap">
                            @foreach($gradetypes AS $key => $value)
                                <div class="ml-2">
                                    <label>{{ $value }}</label>
                                    <input type="checkbox"
                                           wire:click="updateGrades({{ $key }})"
                                           name="grades[{{ $key }}]"
                                           id="grades[{{ $key }}]"
                                           @if($grades[$key]) CHECKED @endif
                                           value="1"
                                    />
                                </div>
                            @endforeach

                        </div>

                        @if(! $grades_found)
                            <div class="section_advisory text-sm text-red-900 bg-red-100 mb-2 p-2 border border-red-400 rounded ">
                                Grades enable significant student, organization, and event functionality. You are strongly
                                encouraged to check at least one grade.
                            </div>
                        @endif
                    </section>

                </x-slot>

                <x-slot name="footer">
                    <x-buttons.secondary wire:click="cancelAdd" >Cancel</x-buttons.secondary>
                    <x-buttons.button wire:click="add" >Add New School</x-buttons.button>
                </x-slot>
            </x-modals.dialog>

            <!-- Delete Modal -->
            <form wire:model.prevent="deleteSelected" >
                <x-modals.confirmation wire:model="showDeleteModal">

                    <x-slot name="title">Delete a School</x-slot>

                    <x-slot name="content">

                        @if(count($selected))
                            Are you sure you want to delete @if(count($selected) > 1) these schools @else this school @endif ?
                        @else
                            No schools were selected to be deleted.
                        @endif

                    </x-slot>

                    <x-slot name="footer">
                        <x-buttons.secondary wire:click="$toggle('showDeleteModal', false)">Cancel</x-buttons.secondary>
                        <x-buttons.button type="submit" wire:click="deleteSelected">Delete School</x-buttons.button>
                    </x-slot>

                </x-modals.confirmation>
            </form>

        </x-slot>

        <x-slot name="actions">


        </x-slot>

    </x-table-with-modal-form>
</div>
