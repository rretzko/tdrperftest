<div>
    <x-livewire-table-with-modal-forms >

        <x-slot name="title">
            {{ __('Student Information') }}
        </x-slot>

        <x-slot name="description">

            <x-sidebar-blurb blurb="Add or edit your student information here." />

            <x-sidebar-blurb blurb="Click the <b>Current</b> link to display your current students." />

            <x-sidebar-blurb blurb="Click the <b>Alum</b> link to display your graduates." />

            <x-sidebar-blurb blurb="Click the <b>All</b> link to display every student in your database." />

            <x-sidebar-blurb blurb="Click the <b>Name</b> column header to sort your students A-Z or Z-A." />

            <x-sidebar-blurb blurb="Click the <b>Grade</b> column header to sort your students by year of graduation." />

            <x-sidebar-blurb blurb="Click the <b>Voice Part</b> column header to sort your students A-Z within their voice part.<br />
            <span class='text-yellow-200'>Note: </span> 'Voice Part' displays the first voice part found for the student.
                    All voice parts and instruments can be found by clicking the 'Edit' button." />

            <x-sidebar-blurb blurb="Click the <span class='bg-blue-400 text-white'> Edit </span> button to display each student's profile information." />

            <x-sidebar-blurb blurb="Per Page: View up to 50 names per page." />

            <x-sidebar-blurb blurb="Bulk Actions: Use the checkbox next to each student's name to create lists to download or delete.
            Downloads will be exported to a .csv file." />

        </x-slot>

        <x-slot name="table" >
            {{-- Student table --}}
            {{-- Per Page, Bulk actions and ADD button --}}
            <div class="flex justify-end pr-6 space-x-2">
                <x-inputs.dropdowns.perpage />
                <x-inputs.dropdowns.bulkactions :selected="$selected" />
                <!-- <x-buttons.button-add toggle="showstudentmodal" /> -->
                <div
                    wire:click="buttonAdd()"
                    class="bg-green-200 px-0.5 shadow-lg border border-green-600 rounded-md text-center cursor-pointer"
                    style="max-width: 4rem;"
                >
                    Add
                </div>
            </div>

            {{-- School Selector --}}
            @if($schools->count())
                <x-inputs.schoolselector currentid="{{ $schoolcurrent }}" :schools="$schools" />
            @endif


            {{-- beginning of tailwindui table --}}
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                <div class="py-2 align-middle inline-block min-w sm:px-6 lg:px-8">
                    <div class="space-y-4 overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <div class="flex space-x-4">
                            <div class="flex">
                                <x-inputs.text wire:model="search"
                                       for="search"
                                       label=""
                                       placeholder="Search last name..."/>
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
                        </div>

                        {{-- CURRENT/ALUM/ALL FILTER DISPLAY OPTIONS --}}
                        <x-navs.currentalumall :population="$population" />

                        <x-tables.surgetable class="w-full ">
                            <x-slot name="head" >

                                <x-tables.heading >
                                    <x-inputs.checkbox class="pr-0 w-4" for="selectpage" label=""/>
                                </x-tables.heading>

                                <x-tables.heading >
                                    <span class="sr-only">Photo</span>
                                </x-tables.heading>

                                <x-tables.heading wire:click.prevent="sortField('name')"
                                      sortable
                                      direction="asc"
                                      :direction="$sortfield === 'name' ? $sortdirection : null"
                                >
                                    Name
                                </x-tables.heading>

                                <x-tables.heading wire:click.prevent="sortField('classof')"
                                      sortable
                                      direction="asc"
                                      :direction="$sortfield === 'classof' ? $sortdirection : null"
                                >
                                    Grade
                                </x-tables.heading>

                                <x-tables.heading wire:click.prevent="sortField('instrumentation')"
                                      sortable
                                      direction="asc"
                                      :direction="$sortfield === 'instrumentation' ? $sortdirection : null"
                                >
                                    Voice Part
                                </x-tables.heading>

                                <th><span class="sr-only">Edit</span></th>

                            </x-slot>

                            <x-slot name="body" >

                                @if($selectpage)
                                    <x-tables.row class="bg-gray-200" wire:key="row-message">
                                        <x-tables.cell colspan="6">
                                            @unless($selectall)
                                                <div>You have selected <strong>{{ count($selected) }}</strong> students, do
                                                    you want to select all <strong>{{ $students->total() }}</strong>?
                                                    <x-buttons.button-link wire:click="selectAll"
                                                                           class="ml-1 text-blue-600">Select All
                                                    </x-buttons.button-link>
                                                </div>
                                            @else
                                                <span>You have selected all <strong>{{ $students->total() }}</strong>
                                                    students.</span>
                                            @endunless
                                        </x-tables.cell>
                                    </x-tables.row>
                                @endif

                                @forelse($students AS $student)
                                    <x-tables.row wire:loading.class.delay="opacity-50" altcolor="{{$loop->iteration % 2}}" wire:key="row-{{ $student->user_id }}">

                                        <x-tables.cell>
                                            <x-inputs.checkbox value="{{ $student->user_id }}" class="" for="selected" label="" />
                                        </x-tables.cell>

                                        <x-tables.cell>
                                            @if($student->person->user->profile_photo_path ?: false)
                                                <div>
                                                    <img class="w-8 h-10 rounded-full inset-0 object-cover" src="{{ '/storage/'.$student->person->user->profile_photo_path }}" />
                                                </div>
                                            @else {{-- display default silhouette icon --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-10" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                            @endif
                                        </x-tables.cell>

                                        <x-tables.cell>
                                            <span title="{{ $student->user_id }}">{{ $student->person->fullNameAlpha }}</span>
                                        </x-tables.cell>
                                        <x-tables.cell>
                                            {{ $student->grade }} ({{ $student->classof }})
                                        </x-tables.cell>

                                        <x-tables.cell>
                                            {{ $student->person->user->instrumentations->count() ? $student->person->user->instrumentations->first()->formattedDescr() : 'None found'}}
                                        </x-tables.cell>

                                        <x-tables.cell>
                                            <x-buttons.button-link
                                                wire:click.defer="edit({{ $student->user_id }})"
                                                class="border border-blue-500 rounded px-2 bg-blue-400 text-white hover:bg-blue-600"
                                            >
                                                Edit
                                            </x-buttons.button-link>
                                        </x-tables.cell>

                                    </x-tables.row>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-gray-500 text-center">
                                            No Student found @if(strlen($this->search)) with search value: {{ $this->search }}@endif.
                                        </td>
                                    </tr>
                                @endforelse

                                <div class="mb-2">
                                    {{$students->count() ? $students->links() : ''}}
                                </div>
                            </x-slot>

                        </x-tables.surgetable>

                        {{-- PAGINATION --}}
                        <div class="mb-2">
                            @if($students->count() > 5)
                                {{$students->count() ? $students->links() : ''}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODALS --}}
            {{-- ADD/EDIT STUDENT --}}
            <div>
                @if($showstudentmodal)

                    <x-modals.student :student="$editstudent" tab="{{ $tab }}" />
                @endif
            </div>

            {{-- DELETE STUDENT --}}
            <div>
                @if($showDeleteModal)
                     <x-modals.delete :selected="$selected" objectname="student" />
                @endif
            </div>



        </x-slot>

        <x-slot name="actions" >


        </x-slot>

    </x-livewire-table-with-modal-forms>
</div>

