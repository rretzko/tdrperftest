@props([
'compositioncollectiontypes',
'compositiontypes',
'editcomposition',
'geostates',
'publisherselected',
'publisherslist',
'showpublisherform',
])
<div>
    <x-modals.confirmation wire:model="showeditmodal">

        <x-slot name="title">@if($editcomposition->id) Edit {{ $editcomposition->title }} @else Add a New Composition @endif</x-slot>

        <x-slot name="content">

            <form wire:submit.prevent="save">
                <x-inputs.group x-data x-init="$refs.title.focus()" label="Title" for="title" >
                    <x-inputs.text label="" x-ref="title" for="editcompositiontitle" placeholder="Composition title..."  />
                    <x-inputs.text label="Subtitle"  for="editcompositionsubtitle" placeholder="Optional subtitle..."  />
                    <x-inputs.text label="From"  for="editcompositionfrom" placeholder="Optional (ex: A Chorus Line)..."  />
                </x-inputs.group>

                <x-inputs.group   label="Publisher" for="publisher_id">

                    <div class="flex sm:flex-col">

                        <x-inputs.text
                            label=""
                            for="publishername"
                            immediate="true"
                        />

                        @if($showpublisherform) {{-- Display publisher subform for adding a new publisher --}}

                            <x-forms.subform-publisher :geostates="$geostates"/>

                        @else {{-- Display list of publishers --}}
                            @if(! $publisherselected)
                                @forelse($publisherslist AS $key => $publishername)
                                    <div class="ml-4">
                                        <span  wire:click="loadPublisher({{ $key }})"
                                            class="text-gray-900 text-xs cursor-pointer"
                                        >
                                            {{ $publishername }}
                                        </span>
                                    </div>

                                @empty

                                    <div class="text-gray-400 text-center text-lg">No publishers found</div>

                                @endforelse
                            @endif
                        @endif

                    </div>

                </x-inputs.group>

                <x-inputs.group label="Types" for="editcompositioncompositiontype" >
                    <x-inputs.select wire:model="editcompositioncompositiontype_id" label="Composition type" for="editcompositioncompositiontype_id" :options="$compositiontypes"  />
                    <x-inputs.select wire:model="editcompositioncompositioncollectiontype_id" label="Collection type" for="editcompositioncompositioncollectiontype_id" :options="$compositioncollectiontypes"  />
                </x-inputs.group>

                <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
                    <x-saves.save-message-without-button message="Composition {{ ($editcomposition->id) ? 'updated' : 'added' }}" trigger="composition-saved"/>
                    <x-buttons.button wire:click="save" type="submit">@if($editcomposition->id) Update {{ ucwords($editcomposition->title) }} @else Add New Composition @endif</x-buttons.button>
                </footer>
            </form>

        </x-slot>

        <x-slot name="footer" >
            <x-buttons.secondary wire:click="$toggle('showeditmodal', false)">Cancel</x-buttons.secondary>
        </x-slot>

    </x-modals.confirmation>
</div>
