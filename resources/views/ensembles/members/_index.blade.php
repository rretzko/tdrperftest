<x-app-layout>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <x-table-with-modal-form >

                <x-slot name="title" >
                    {{ __('Ensemble Member Roster') }}
                </x-slot>

                <x-slot name="description" >

                    {!! __('Add or edit your ensemble membership roster here.<br />
                    <ul class="ml-5 list-disc text-white text-sm" >
                    <li>Click the number under the "Members" column to add/edit ensemble membership.</li>
                    <li>Ensemble names are unique to you and your school.  Please do not delete ensembles which have members assigned.</li>
                    <li>If necessary, deleted Ensembles can be reinstated by contacting
                    <a style="color: yellow" href="mailto:support@thedirectorsroom.com?subject=Ensemble reinstatement&body=Hi, I may need an ensemble name reinstated...">
                    Support
                    </a>.
                    </li>
                    </ul>') !!}

</x-slot>

<x-slot name="table">
    {{-- HEADER --}}
    <div id="membershipHeader">
        <h3 class="font-bold">{{ $ensemble->name }} Membership Roster</h3>
    </div>

{{-- ADD button --}}
<div class="flex justify-end mb-2 pr-6">
    <div
        class="bg-green-200 px-1 shadow-lg border border-green-600 rounded-md text-center cursor-pointer"
        style="max-width: 4rem;"
    >
        <a href="{{ route('ensemble.members.create', ['ensemble' => $ensemble, 'schoolyear' => $schoolyear]) }}"
            class="text-green-800">Add</a>
    </div>

</div>

<div class="overflow-x-auto">
    @livewire('ensembles.members-table', ['countmembers' => "$countmembers"])
    <script>
        function chickenTest($object)
        {
            return confirm('Do you really want to delete the member?');
        }
    </script>
</div>
</x-slot>

</x-table-with-modal-form>

<x-jet-section-border />

</div>

</x-app-layout>
