<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div>

                <x-livewire-table-with-modal-forms>

                    <x-slot name="title">
                        {{ __('Membership Card') }}
                    </x-slot>

                    <x-slot name="description">

                        <x-sidebar-blurb blurb="Record your membership information here for {{ $organization->name }}." />

                        <x-sidebar-blurb blurb="This membership card will also display for: {!! $ancestors !!}"/>

                    </x-slot>

                    <x-slot name="table">

                        <section class="w-full border border-black border-t-0 border-l-0 border-r-0 " id="page_header">
                            {{-- BACK TO ROSTER --}}
                            <div class="flex text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 20 20"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                <a href="{{ route('organizations.index') }}"
                                   class="text-red-700 ml-2 pb-4">
                                    Return to Organization Roster
                                </a>
                            </div>

                            <h3 class="font-bold">{{ $organization->name }} Membership</h3>
                        </section>

                        <section  class="flex" id="inputs_and_card">

                            <section class="w-9/12" id="inputs">
                                {{-- MEMBERSHIP CARD FORM --}}
                                <div class="overflow-x-auto lg:w-6/12 md:w-8/12 w-11/12 ">

                                    @if(config('app.url') === 'http://localhost')
                                        <form method="post" action="{{ ($membership && $membership->id)
                                            ? route('organization.membershipcard.update', ['membership' => $membership])
                                            : route('organization.membershipcard.create')}}"
                                              enctype="multipart/form-data"
                                        >
                                    @else
                                        <form method="post" action="{{ ($membership && $membership->id)
                                            ? 'https://thedirectorsroom.com/organization/membershipcard/'.$membership->id.'/update'
                                            : 'https://thedirectorsroom.com/organization/membershipcard/create' }}"
                                              enctype="multipart/form-data"
                                        >
                                    @endif

                                        @csrf

                                        {{-- MEMBERSHIP TYPE --}}
                                        <x-inputs.group label="Membership type" for="membershiptype_id">

                                            <select name="membershiptype_id">
                                                @foreach($membershiptypes AS $membershiptype)
                                                    <option value="{{ $membershiptype->id }}"
                                                        {{ (($membership->membershiptype_id == $membershiptype->id) ? 'SELECTED' : '' )}}
                                                    >
                                                        {{ $membershiptype->descr }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </x-inputs.group>

                                        {{-- MEMBERSHIP ID --}}
                                        <x-inputs.group label="Membership id" for="membership_id" borderless="true" paddingless="true">

                                            <x-inputs.text
                                                label=""
                                                for="membership_id"
                                                currentvalue="{{ $membership->membership_id }}"

                                            />

                                        </x-inputs.group>

                                        {{-- EXPIRATION --}}
                                        <x-inputs.group label="Expiration date"
                                                        for="expiration"
                                                        borderless="true"
                                                        paddingless="true"
                                        >

                                            <x-inputs.date
                                                label=""
                                                for="expiration"
                                                currentvalue="{{ $membership->expiration }}"
                                            />

                                        </x-inputs.group>

                                        {{-- GRADE LEVELS --}}
                                        <x-inputs.group label="Grade levels"
                                                        for="grade_levels"
                                                        borderless="true"
                                                        paddingless="true"
                                        >

                                            <x-inputs.text
                                                label=""
                                                for="grade_levels"
                                                placeholder="Secondary, middle, elementary"
                                                currentvalue="{{ $membership->grade_levels }}"
                                            />

                                        </x-inputs.group>

                                        {{-- SUBJECTS --}}
                                        <x-inputs.group label="Subjects" for="subjects" borderless="true" paddingless="true">

                                            <x-inputs.text
                                                label=""
                                                for="subjects"
                                                placeholder="Chorus, General Music"
                                                currentvalue="{{ $membership->subjects }}"
                                            />

                                        </x-inputs.group>

                                        {{-- MEMBERSHIP CARD --}}

                                        <x-inputs.group label="Membership card" for="membershipcard" borderless="true" paddingless="true">

                                            <input type="file" name="membershipcard">
                                            <div style="font-size: 0.8rem; color: red;">Image files ONLY (png,jpg)!</div>

                                        </x-inputs.group>

                                        <x-inputs.group for="submit" label="" borderless="true" >
                                            <x-buttons.button-save />
                                        </x-inputs.group>
                                    </form>
                                </div>
                            </section>

                            <section class="w-2/12" id="card">
                                <h4 class="font-bold">Card Image</h4>

                                @if(strlen($membership_card_url))

                                    <img src="{{ $membership_card_url }}"
                                         alt="membership card"
                                    />
                                @else Card not found
                                @endif

                            </section>

                        </section>
                    </x-slot>

                </x-livewire-table-with-modal-forms>

            </div>

        </div>
    </div>

    <x-jet-section-border />

</x-app-layout>
