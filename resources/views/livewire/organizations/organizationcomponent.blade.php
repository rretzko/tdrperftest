<div>
    <div>
        <x-livewire-table-with-modal-forms >

            <x-slot name="title">
                {{ __('Organization Information') }}
            </x-slot>

            <x-slot name="description">
<!-- {{--
                <x-sidebar-blurb blurb="Add or edit your organization information here." />
--}} -->
                <x-sidebar-blurb blurb="If you have students interested in an audition (NJ All-State Chorus, for example),
                the organization sponsoring that audition will want to confirm that you're a member in good standing.
                This page is designed to allow you to record your membership information, including uploading a copy of
                your membership card." />

                <x-sidebar-blurb blurb="Organizations (NAfME, ACDA, etc. and their subsidiaries) can have the following status:
                    <ul class='ml-4 list-disc'>
                        <li><b>auds</b>: This organization is using our system to manage their ensemble auditions.</li>
                        <li><b>tdr</b>: Directors from that organization are independently using TheDirectorsRoom.com.</li>
                        <li><b>none</b>: Neither the organization nor their any of their members are using our system.</li>
                    <ul>" />

                <x-sidebar-blurb blurb="Your membership is confirmed with the an up-to-date,
                    missing, or expired Member Badge.  Hovering over the Member Badge will display the expiration date we have on record.
                    To update your membership information, click the button under the '<b>Card</b>' column." />

                <x-sidebar-blurb blurb="Organizations tell us who their members are.  If you see an organization to which
                you belong, but without the appropriate badge, you may be able to contact the Membership Manager directly
                from this page. If the 'Request' button is blue, you can quickly request membership by clicking that button,
                or hover over the button to see the contact information for the Membership Manager.<br />
                    <span class='text-yellow-200'>NOTE</span>: Request membership approval at the lowest applicable level as
                    approval will be reflected upward but not vice-versa! For example: Requesting membership in CJMEA
                    will automatically link to membership in NJMEA, the Eastern Division and NAfME.  However, requesting
                    membership in NJMEA will not grant you membership in any of the regional organizations." />
<!-- {{--
                <x-sidebar-blurb blurb="Use the <b>Card</b> button to update your membership information and
                upload your membership card.  This is useful for organzations using
                AuditionForms.com to manage their auditioned ensembles. These organization will have an 'auds' listing
                under the Status column." />
--}} -->
            </x-slot>

            <x-slot name="table">
                {{-- Organizations table --}}
                {{-- Per Page and Bulk actions are commented out but left for future usage --}}
                <div class="flex justify-between pr-6 space-x-2">
                    <!-- <x-inputs.dropdowns.perpage />
                    <x-inputs.dropdowns.bulkactions :selected="$selected" /> -->
                    <div class="mb-2 @if($emailsent) p-1 w-10/12 bg-green-50 text-green-700 border border-black rounded @endif">
                        {{ $emailsent }}
                    </div>

                  <!-- {{--  <x-buttons.button-add toggle="showaddmodal" /> --}} -->
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
                                <x-slot name="head" >

                                    <th title="Parent" ><span class="text-gray-200">P</span></th>
                                    <th title="Section" ><span class="text-gray-200">S</span></th>
                                    <th title="State" ><span class="text-gray-200">T</span></th>
                                    <th title="Region" ><span class="text-gray-200">R</span></th>
                                    <th title="Subregion" ><span class="text-gray-200">U</span></th>

                                    <th class="px-2" title="Is this organization participating in AuditionSuite.org?">Status?</th>
                                    <th class="px-2" title="Does the system recognize you as a member of this organization?">Member?</th>
                                    <th class="px-2" title="Does the system have a current copy of your membership card?">Card?</th>

                                </x-slot>

                                <x-slot name="body" >

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

                                @forelse($organizations AS $organization)

                                    <x-tables.row
                                            wire:loading.class.delay="opacity-50"
                                            style="{{ $organization->hasChildren ? 'border-bottom: 0px solid transparent;' : '' }} "
                                            wire:key="row-{{ $organization->id }}"
                                            altcolor="{{$loop->even}}"

                                        >
                                        <td colspan="5"
                                                   class="px-2 @if($organization->hasChildren) py-0 @endif">
                                                <b>{{ $organization->name }}</b>
                                            </td>

                                            <td class="text-center">
                                                {!! $organization->auditionsuiteStatus !!}
                                            </td>

                                            <td>
                                                @if($organization->isMember(auth()->id())) {{-- non-pending membership status --}}
                                                    <span
                                                        class="{{ $organization->membership(auth()->id()) &&
                                                            $organization->membership(auth()->id())->expiration &&
                                                            (! $organization->membership(auth()->id())->expired()) ? 'bg-green-500' : 'bg-red-500' }} rounded px-2 text-white text-sm"
                                                        title="Expiration Date: {{ $organization->membership(auth()->id()) &&
                                                            $organization->membership(auth()->id())->expiration ? $organization->membership(auth()->id())->expirationMdy() : 'none' }}"
                                                    >
                                                        {{ ucwords($organization->membership(auth()->id())->membershiptype->descr) }}
                                                    </span>
                                                @elseif($organization->isPending(auth()->id()))
                                                    <span
                                                        class="bg-indigo-500 rounded px-2 text-white text-sm"
                                                        title="Pending Membership Manager approval"
                                                    >
                                                        Pending
                                                    </span>
                                                @elseif($membershipmanagers[$organization->id] === 'No membership manager found.')
                                                    <span
                                                        class="border border-gray-500 rounded bg-gray-400 hover:bg-gray-600 px-2 text-white"
                                                    >
                                                        <span title="No membership manager found.">Request</span>
                                                    </span>
                                                @else
                                                    <x-buttons.button-link
                                                        wire:click="requestMembership({{ $organization->id }})"
                                                        class="border border-blue-500 rounded bg-blue-400 hover:bg-blue-600 px-2  text-white "
                                                    >
                                                        <span title="{{$membershipmanagers[$organization->id]}}">Request</span>
                                                    </x-buttons.button-link>
                                                @endif
                                            </td>

                                            <td style="padding-right: .5rem;">
                                                <a href="{{ route('organization.membershipcard', ['organization' => $organization]) }}"
                                                   class="border border-gray-800 rounded px-2 bg-gray-600 text-white hover:bg-gray-400"
                                                   title="Click to add your {{ $organization->abbr }} membership card"
                                                >
                                                    Card
                                                </a>

                                            </td>

                                        </x-tables.row>

                                        {{-- ADD SECTION ROW IF PARENT HAS CHILDREN --}}
                                        @if($organization->hasChildren)
                                            @foreach($organization->children() AS $child)
                                                <x-tables.row
                                                    wire:loading.class.delay="opacity-50"
                                                    wire:key="row-{{ $child->id }}"
                                                    style="border-top: 0px solid transparent;"
                                                    altcolor="{{$loop->parent->even}}"
                                                >

                                                    <td class=py-1"></td>

                                                    <td colspan="4"
                                                        class="py-1" title="{{ $child->name }}">
                                                        {{ $child->abbr }}
                                                    </td>

                                                    <td class="text-center py-1">
                                                        {!! $child->auditionsuiteStatus !!}
                                                    </td>

                                                    <td class=" py-1">
                                                        @if($child->isMember(auth()->id())) {{-- non-pending membership status --}}
                                                            <span
                                                                class="{{ $child->membership(auth()->id()) &&
                                                                $child->membership(auth()->id())->expiration &&
                                                                (! $child->membership(auth()->id())->expired()) ? 'bg-green-500' : 'bg-red-500' }} rounded px-2 text-white text-sm"
                                                                title="Expiration Date: {{ $child->membership(auth()->id()) &&
                                                                $child->membership(auth()->id())->expiration ? $child->membership(auth()->id())->expirationMdy() : 'none' }}"
                                                            >
                                                            {{ ucwords($child->membership(auth()->id())->membershiptype->descr) }}
                                                            </span>
                                                        @elseif($child->isPending(auth()->id()))
                                                            <span
                                                                class="bg-indigo-500 rounded px-2 text-white text-sm"
                                                                title="Pending Membership Manager approval"
                                                            >
                                                                Pending
                                                            </span>
                                                        @elseif($membershipmanagers[$child->id] === 'No membership manager found.')
                                                            <span
                                                                class="border border-gray-500 rounded bg-gray-400 hover:bg-gray-600 px-2 text-white"
                                                            >
                                                                        <span title="No membership manager found.">Request</span>
                                                                    </span>
                                                        @else
                                                            <x-buttons.button-link
                                                                wire:click="requestMembership({{ $child->id }})"
                                                                class="border border-blue-500 rounded bg-blue-400 hover:bg-blue-600 px-2  text-white "
                                                            >
                                                                <span title="{{$membershipmanagers[$child->id]}}">Request</span>
                                                            </x-buttons.button-link>
                                                        @endif
                                                    </td>

                                                    <td class=" py-1">
                                                        <a href="{{ route('organization.membershipcard', ['organization' => $child]) }}"
                                                           class="border border-green-500 rounded px-2 bg-green-600 text-white hover:bg-green-400"
                                                           title="Click to add your {{ $child->abbr }} membership card"
                                                        >
                                                            Card
                                                        </a>

                                                    </td>

                                                </x-tables.row>

                                                {{-- ADD SECTION ROW IF CHILD HAS GRANDCHILDREN --}}

                                                @if($child->hasChildren)
                                                    @foreach($child->children() AS $grandchild)
                                                        <x-tables.row
                                                            wire:loading.class.delay="opacity-50"
                                                            wire:key="row-{{ $grandchild->id }}"
                                                            style="border-top: 0px solid transparent;"
                                                            altcolor="{{$loop->parent->parent->even}}"
                                                        >

                                                            <td class="py-1"></td>

                                                            <td class="py-1"></td>

                                                            <td colspan="3"
                                                                class="py-1" title="{{ $grandchild->name }}">
                                                                {{ $grandchild->abbr }}
                                                            </td>

                                                            <td class="text-center py-1">
                                                                {!! $grandchild->auditionsuiteStatus !!}
                                                            </td>

                                                            <td class=" py-1">
                                                                @if($grandchild->isMember(auth()->id())) {{-- non-pending membership status --}}
                                                                    <span
                                                                        class="{{ $grandchild->membership(auth()->id()) &&
                                                                        $grandchild->membership(auth()->id())->expiration &&
                                                                        (! $grandchild->membership(auth()->id())->expired()) ? 'bg-green-500' : 'bg-red-500' }} rounded px-2 text-white text-sm"
                                                                                title="Expiration Date: {{ $grandchild->membership(auth()->id()) &&
                                                                        $grandchild->membership(auth()->id())->expiration ? $grandchild->membership(auth()->id())->expirationMdy() : 'none' }}"
                                                                            >
                                                                        {{ ucwords($grandchild->membership(auth()->id())->membershiptype->descr) }}
                                                                    </span>
                                                                @elseif($grandchild->isPending(auth()->id()))
                                                                    <span
                                                                        class="bg-indigo-500 rounded px-2 text-white text-sm"
                                                                        title="Pending Membership Manager approval"
                                                                    >
                                                                        Pending
                                                                    </span>
                                                                @elseif($membershipmanagers[$grandchild->id] === 'No membership manager found.')
                                                                    <span
                                                                        class="border border-gray-500 rounded bg-gray-400 hover:bg-gray-600 px-2 text-white"
                                                                    >
                                                                        <span title="No membership manager found.">Request</span>
                                                                    </span>
                                                                @else
                                                                    <x-buttons.button-link
                                                                        wire:click="requestMembership({{ $grandchild->id }})"
                                                                        class="border border-blue-500 rounded bg-blue-400 hover:bg-blue-600 px-2  text-white "
                                                                        >
                                                                        <span title="{{$membershipmanagers[$grandchild->id]}}">Request</span>
                                                                    </x-buttons.button-link>
                                                                @endif
                                                            </td>

                                                            <td class=" py-1">
                                                                <a href="{{ route('organization.membershipcard', ['organization' => $grandchild]) }}"
                                                                   class="border border-green-500 rounded px-2 bg-green-600 text-white hover:bg-green-400"
                                                                   title="Click to add your {{ $grandchild->abbr }} membership card"
                                                                >
                                                                    Card
                                                                </a>

                                                            </td>

                                                        </x-tables.row>
                                                    {{-- @endforeach --}}

                                                    {{-- ADD SECTION ROW IF GRANDCHILD HAS GREATGRANDCHILDREN --}}

                                                        @if($grandchild->hasChildren)
                                                            @foreach($grandchild->children() AS $greatgrandchild)
                                                                <x-tables.row
                                                                    wire:loading.class.delay="opacity-50"
                                                                    wire:key="row-{{ $greatgrandchild->id }}"
                                                                    style="border-top: 0px solid transparent;"
                                                                    altcolor="{{$loop->parent->parent->even}}"
                                                                >

                                                                    <td class="py-1"></td>

                                                                    <td class="py-1"></td>

                                                                    <td class="py-1"></td>

                                                                    <td colspan="2"
                                                                        class="py-1" title="{{ $greatgrandchild->name }}">
                                                                        {{ $greatgrandchild->abbr }}
                                                                    </td>

                                                                    <td class="text-center py-1">
                                                                        {!! $greatgrandchild->auditionsuiteStatus !!}
                                                                    </td>

                                                                    <td class=" py-1">
                                                                        @if($greatgrandchild->isMember(auth()->id())) {{-- non-pending membership status --}}
                                                                            <span
                                                                                class="{{ $greatgrandchild->membership(auth()->id()) &&
                                                                                $greatgrandchild->membership(auth()->id())->expiration &&
                                                                                (! $greatgrandchild->membership(auth()->id())->expired()) ? 'bg-green-500' : 'bg-red-500' }} rounded px-2 text-white text-sm"
                                                                                                title="Expiration Date: {{ $greatgrandchild->membership(auth()->id()) &&
                                                                                $greatgrandchild->membership(auth()->id())->expiration ? $greatgrandchild->membership(auth()->id())->expirationMdy() : 'none' }}"
                                                                                            >
                                                                                {{ ucwords($greatgrandchild->membership(auth()->id())->membershiptype->descr) }}
                                                                            </span>
                                                                        @elseif($greatgrandchild->isPending(auth()->id()))
                                                                            <span
                                                                                class="bg-indigo-500 rounded px-2 text-white text-sm"
                                                                                title="Pending Membership Manager approval"
                                                                            >
                                                                                Pending
                                                                            </span>
                                                                        @elseif($membershipmanagers[$greatgrandchild->id] === 'No membership manager found.')
                                                                            <span
                                                                                class="border border-gray-500 rounded bg-gray-400 hover:bg-gray-600 px-2 text-white"
                                                                            >
                                                                        <span title="No membership manager found.">Request</span>
                                                                    </span>
                                                                        @else
                                                                            <x-buttons.button-link
                                                                                wire:click="requestMembership({{ $greatgrandchild->id }})"
                                                                                class="border border-blue-500 rounded bg-blue-400 hover:bg-blue-600 px-2  text-white "
                                                                            >
                                                                                <span title="{{$membershipmanagers[$greatgrandchild->id]}}">Request</span>
                                                                            </x-buttons.button-link>
                                                                        @endif
                                                                    </td>

                                                                    <td class=" py-1">
                                                                        <a href="{{ route('organization.membershipcard', ['organization' => $greatgrandchild]) }}"
                                                                           class="border border-green-500 rounded px-2 bg-green-600 text-white hover:bg-green-400"
                                                                           title="Click to add your {{ $greatgrandchild->abbr }} membership card"
                                                                        >
                                                                            Card
                                                                        </a>

                                                                    </td>

                                                                </x-tables.row>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif

                                            @endforeach
                                        @endif

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-gray-500 text-center">
                                            No Organization found @if(strlen($this->search)) with search value: {{ $this->search }}@endif.
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

            <x-slot name="actions" >


            </x-slot>

        </x-livewire-table-with-modal-forms>
    </div>



</div>
