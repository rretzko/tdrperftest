<x-app-layout>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <x-table-with-modal-form >

                <x-slot name="title" >
                    {{ __('Ensemble Asset types') }}
                </x-slot>

                <x-slot name="description" >

                    <x-sidebar-blurb blurb="Add or edit your ensemble assets here." />

                    <x-sidebar-blurb blurb="Ensemble assets are anything which you assign to an ensemble member." />

                    <x-sidebar-blurb blurb="Click any checkbox to add an asset type to <b>{{ $ensemble->name }}</b> for
                            <b>{{ $schoolyear->descr }}</b>." />

                    <x-sidebar-blurb blurb="Once an asset type is added, you will be able to create a catalog for all assets assigned to
                            each <b>{{ $ensemble->name }}</b> member." />

                    <x-sidebar-blurb blurb="Click the 'Add' button to add a new asset type to the list." />

                    <x-sidebar-blurb blurb="Edit/Delete buttons are displayed for all assets which you have created
                            and which have <b>NOT</b> been used by another teacher." />

                    <x-sidebar-blurb blurb="Deleting an asset will also delete <b>ALL</b> ensemble and student links
                        to that asset." />



                </x-slot>

                <x-slot name="table">
                    {{-- HEADER --}}
                    <div id="assetHeader">
                        <h3 class="font-bold">{{ $ensemble->name }} Asset Types</h3>
                    </div>

                <div class="overflow-x-auto">

                   @livewire('ensembles.assets-table' )

                </div>

            </x-slot>



</x-table-with-modal-form>

<x-jet-section-border />

</div>

</x-app-layout>
