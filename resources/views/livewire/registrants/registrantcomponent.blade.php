<div>
    <div>
        <x-livewire-table-with-modal-forms>

            <x-slot name="title">
                {{ __('Registrant Dashboard') }}
            </x-slot>

            <x-slot name="description">

                <x-sidebar-blurb blurb="Add or edit your registrant information here."/>

                <x-sidebar-blurb blurb="Registrants have three status types: Eligible, Applied, and Registered." />

                <x-sidebar-blurb blurb="Click the 'Eligible' column header to toggle the roster for each status type." />

                <x-sidebar-blurb blurb="As students progress from Eligible to Applied and Registered, the 'Registration
                Progress' bar will update to keep you aware of that progress." />

                <x-sidebar-blurb blurb="Click the <a class='text-yellow-100' href='{{ route('pitchfiles',['eventversion' => $event]) }}'>Pitch Files button</a> icon to access the pitch files." />

                <x-sidebar-blurb blurb="Students with a status type of 'Registered' will appear on your
                    <a class='text-yellow-100' href='{{ route('registrant.estimateform',['eventversion' => $event]) }}'>Estimate</a> form
                    located between the Search bar and the Pitch Files button." />

                <x-sidebar-blurb blurb="You may keep a record of your student payments by clicking on the
                    <a class='text-yellow-100' href='{{ route('registrant.payments',['eventversion' => $event]) }}'>'Payments'</a> link
                    located between the Search bar and the Pitch Files button." />

                <div class="mb-1.5 text-white">{!! $registrantstatus !!}</div>

                <x-sidebar-blurb blurb="Three status graphics may display as follows:<ul style='margin-left: 1rem;'>
                <li><b class='text-yellow-100' >Dash:</b> The item has not been found.</li>
                <li><b class='text-yellow-100' >Plus sign:</b> The item has been found but further action needs to be taken.</li>
                <li><b class='text-yellow-100' >Checkmark:</b> The item is complete and no further action is needed.</li>
                </ul>Note: Float over the graphics for additional specific information!" />

            </x-slot>

            <x-slot name="table">
                {{-- Events table --}}
                {{-- Per Page and Bulk actions are commented out but left for future usage --}}
                <div class="flex justify-end pr-6 space-x-2">
                    <x-inputs.dropdowns.perpage />

                </div>

                {{-- HEADER --}}
                <div class="text-center font-bold text-xl mb-2">
                    {{ $event->name }}  Registration Status Roster
                </div>

                {{-- SCHOOL SELECTOR --}}
                @if($schools->count())
                    <x-inputs.schoolselector currentid="{{ $schoolcurrent }}" :schools="$schools" />
                @endif

                {{-- beginning of tailwindui table --}}

                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                    <div class="py-2 align-middle inline-block min-w sm:px-6 lg:px-8">
                        <div class="space-y-4 overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        {{-- SEARCH --}}
                         <div class="flex space-x-4 justify-between">
                             <div class="flex">
                                <x-inputs.text wire:model.debounce.1s="search"
                                   for="search"
                                   label=""
                                   placeholder="Search last name..."/>
                            </div>

                             {{-- ESTIMATE FORM --}}
                             <div class="pt-3">
                                 @if($event->emergencyContactsMissing)
                                    <div class="bg-yellow-200 text-blue-700 font-bold border border-blue-700 rounded px-2 text-center"
                                        title="Estimate form is disabled until Emergency Contacts are complete">
                                      Estimate
                                    </div>
                                @else
                                     <a href="{{ route('registrant.estimateform',['eventversion' => $event]) }}"
                                        class=" bg-yellow-200 text-blue-700 font-bold border border-blue-700 rounded px-2"
                                        title="{{ $event->name }} estimate form"
                                     >
                                         @if($event->event->id === 19)
                                             Invoice
                                         @else
                                            Estimate
                                         @endif
                                     </a>
                                 @endif
                                 <div style="color: red; font-size: .8rem;">
                                     @if($event->emergencyContactsMissing) Emergency Contacts missing! @endif
                                 </div>
                             </div>

                             {{-- PAYMENT FORM --}}
                             <div class="pt-3">
                                 <a href="{{ route('registrant.payments',['eventversion' => $event]) }}"
                                    class=" bg-green-200 text-green-800 font-bold border border-green-700 rounded px-2"
                                    title="Student Payments"
                                 >
                                     Payments
                                 </a>
                             </div>

                             {{-- PITCH FILES --}}
                             <div class="pt-3">
                                 <a href="{{ route('pitchfiles',['eventversion' => $event]) }}"
                                    class=" bg-blue-200 text-blue-800 font-bold border border-blue-700 rounded px-2"
                                    title="Pitch Files"
                                 >
                                     Pitch Files
                                 </a>
                             </div>

                             {{-- EVENTVERSION ROLES --}}
                             <div class="pt-3">

                                 @if($adjudicator)

                                     <a href="{{ route('registrants.adjudication',['eventversion' => $event]) }}"
                                        class=" bg-black text-white font-bold border border-green-700 rounded px-2 hover:bg-gray-300 hover:text-black"
                                        title="Adjudication page"
                                     >
                                         Judge
                                     </a>

                                 @endif
                             </div>

                        </div>

                        {{-- STUDENT PAYPAL OPTION --}}
                        <div >

                                @if($event->eventversionconfigs->paypalstudent)
                                    <div class="text-white px-1 rounded text-center

                                        @if($event->eventversionteacherconfigs->count() &&
                                            $event->eventversionteacherconfigs->where('user_id', auth()->id())->count() &&
                                            $event->eventversionteacherconfigs->where('user_id', auth()->id())->first()->paypalstudent)
                                            bg-green-700
                                        @else
                                            bg-blue-700
                                        @endif
                                        ">
                                        @if(config('app.url') === 'http://localhost')

                                                <a href=" {{ route('eventversionteacherconfig.update', ['eventversion' => $event]) }}" >
                                                    @if($event->eventversionteacherconfigs->count() &&
                                                        $event->eventversionteacherconfigs->where('user_id', auth()->id())->count() &&
                                                        $event->eventversionteacherconfigs->where('user_id', auth()->id())->first()->paypalstudent)
                                                        Currently, my students can pay through PayPal.
                                                    @else
                                                        Allow my students to pay via PayPal
                                                    @endif
                                                </a>

                                        @else
                                            <a href="https://thedirectorsroom.com/registrants/configs/{{ $event->id }}">
                                                @if($event->eventversionteacherconfigs->count() &&
                                                    $event->eventversionteacherconfigs->where('user_id', auth()->id())->count() &&
                                                    $event->eventversionteacherconfigs->where('user_id', auth()->id())->first()->paypalstudent)
                                                    Currently, my students can pay through PayPal.
                                                @else
                                                    Allow my students to pay via PayPal
                                                @endif
                                            </a>
                                        @endif

                                    </div>
                                @endif

                        </div>

                        {{-- REGISTRATION STATE --}}
                        <div>
                            {!! $schoolregistrationstatus !!}
                        </div>

                            <x-tables.surgetable class="w-full">
                                <x-slot name="head">

                                    <th class="px-1" >###</th>
                                    <th class="px-1" title="Student name">Name</th>
                                    <th class="px-1" title="Event voice part">Voice</th>
                                    <th class="px-1" title="Emergency Contact Check">EC</th>
                                    <th class="px-1" title="Application downloaded">App</th>
                                    @foreach($event->filecontenttypes AS $filecontenttype)
                                        <th class="px-1" title="{{ ucwords($filecontenttype->descr) }} mp3 status">
                                            {{ ucwords(substr($filecontenttype->descr,0,2)) }}
                                        </th>
                                    @endforeach
                                    <th class="px-1" title="Registration status">Status</th>
                                    <th class="px-1 cursor-pointer text-blue-700" title="Status"
                                            wire:click='status'>
                                        {{ ucwords($population) }}
                                    </th>

                                    <th class="sr-only">Edit</th>

                                </x-slot>

                                <x-slot name="body">

                                    @forelse($registrants AS $registrant)
                                        @if($registrant && $registrant->user_id)
                                            <x-tables.row
                                                wire:loading.class.delay="opacity-50"
                                                style=""
                                                wire:key="row-{{ $registrant->user_id }}"
                                                altcolor="{{$loop->even}}"
                                            >
                                                <x-tables.cell>
                                                    {{ $loop->iteration }}
                                                </x-tables.cell>
                                                <x-tables.cell title="{{ $registrant->id }}" >
                                                    {{ $registrant['student']['person']->fullNameAlpha }}
                                                    ({{ $registrant['student']->grade }})
                                                </x-tables.cell>

                                                {{-- VOICE PART --}}
                                                <x-tables.cell class="text-center uppercase">
                                                    {{ $registrant->instrumentationsCSV }}
                                                </x-tables.cell>

                                                {{-- EMERGENCY CONTACT CHECK --}}
                                                <td>@if($registrant->student->emergencyContactStatus)
                                                        {{-- HEROICONS thumbs-up --}}
                                                        <span title="Emergency contact information is confirmed">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                            </svg>
                                                        </span>
                                                    @else
                                                        {{-- HEROICONS thumbs-down --}}
                                                        <span title="Emergency contact information is missing!">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                 fill="none" viewBox="0 0 24 24"
                                                                 stroke="red" stroke-width="2">
                                                              <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                                            </svg>
                                                        </span>
                                                    @endif
                                                </td>

                                                {{-- APPLICATION --}}
                                                <x-tables.cell class="text-center uppercase">
                                                    @if($registrant->hasSignatures)
                                                        {{-- HEROICONS check --}}
                                                        <span title="The application signatures are confirmed">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                        </span>
                                                    @elseif($registrant->hasApplication)
                                                        {{-- HEROICONS plus --}}
                                                        <span title="An application has been downloaded">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                 fill="none" viewBox="0 0 24 24"
                                                                 stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2" d="M12 4v16m8-8H4"/>
                                                            </svg>
                                                        </span>
                                                    @else
                                                        -
                                                    @endif
                                                </x-tables.cell>

                                                {{-- FILE CONTENT TYPES --}}
                                                @foreach($event->filecontenttypes AS $filecontenttype)

                                                    <x-tables.cell class="text-center uppercase">
                                                        @if($registrant->fileuploadapproved($filecontenttype))
                                                            {{-- HEROICONS check --}}
                                                            <span title="{{ ucwords($filecontenttype->descr) }} file uploaded and approved">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                </svg>
                                                            </span>
                                                        @elseif($registrant->hasFileUploaded($filecontenttype))
                                                            {{-- HEROICONS plus --}}
                                                            <span title="{{ ucwords($filecontenttype->descr) }} file uploaded but NOT approved">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                     fill="none" viewBox="0 0 24 24"
                                                                     stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          stroke-width="2" d="M12 4v16m8-8H4"/>
                                                                </svg>
                                                            </span>
                                                        @else
                                                            <span title="No {{ $filecontenttype->descr }} file found">-</span>
                                                        @endif

                                                    </x-tables.cell>

                                                @endforeach

                                                <x-tables.cell >
                                                    <div class="{{ $registrant->registranttypeDescrBackground }} p-1 text-center text-xs border border-gray-400 rounded">
                                                        <div wire:click="registrantstatus({{ $registrant  }})" class="cursor-pointer">
                                                            {{ ucwords($registrant->registranttypeDescr) }}
                                                        </div>
                                                    </div>
                                                </x-tables.cell>

                                                <x-tables.cell>
                                                    @if($registrant->registranttype_id === 18)
                                                        
                                                        <span style="color: red;">PROHIBITED</span>
                                                        
                                                        @elseif(
                                                        ($registrant->registranttype_id === 14) || {{-- QUALIFIED --}}
                                                        ($registrant->registranttype_id === 15) || {{-- APPLIED --}}
                                                        ($registrant->registranttype_id === 16) || {{-- REGISTERED --}}
                                                        $exception)

                                                            <x-buttons.button-link
                                                                class="border border-blue-500 rounded px-2 bg-blue-400 text-white hover:bg-blue-600"
                                                            >
                                                                <a href="{{ route('registrant.show',['registrant' => $registrant]) }}">
                                                                    Edit
                                                                </a>
                                                        </x-buttons.button-link>

                                                    @else
                                                        <div style="color: red;">Event closed</div>


                                                    @endif
                                                </x-tables.cell>
                                            </x-tables.row>
                                        @else

                                            <x-tables.row
                                                wire:loading.class.delay="opacity-50"
                                                style=""
                                                wire:key="row-{{ $registrant->user_id }}"
                                            >
                                                <x-tables.cell>
                                                    registrant {{ $registrant->id.' ('.$registrant->user_id.')' }} found
                                                </x-tables.cell>
                                            </x-tables.row>

                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-gray-500 text-center">
                                                No Registrants found
                                                @if(strlen($this->search))
                                                    with search value: {{ $this->search }}
                                                @endif.
                                            </td>
                                        </tr>

                                @endforelse
                                {{-- PAGINATION TOP LINKS --}}
                                <div class="mb-2">
                                    {{$registrants->count() ? $registrants->links() : ''}}
                                </div>

                                </x-slot>

                            </x-tables.surgetable>

                        {{-- PAGINATION BOTTOM LINKS --}}
                        <div class="mb-2">
                            @if($registrants->count() > 5)
                                {{$registrants->count() ? $registrants->links() : ''}}
                            @endif

                        </div>

                        </div>
                    </div>
                </div>

            </x-slot>

            <x-slot name="actions">

            </x-slot>

        </x-livewire-table-with-modal-forms>

    </div>

</div>



