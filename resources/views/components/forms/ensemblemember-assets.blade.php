@props([
'ensemble',
'member',
'assets',
])
<div class="mt-4">

    <h4 class="font-bold text-lg">{{ $ensemble->name }} assets for: {{ $member->person->fullName }}.</h4>

    <x-tables.surgetable>
            <x-slot name="head">
                <x-tables.heading >Name</x-tables.heading>
                <x-tables.heading >Description - Assigned - Returned</x-tables.heading>
            </x-slot>

            <x-slot name="body">

                @if($ensemble->assets->count())

                    <form wire:submit.prevent="saveAssets" name="assets">

                        @foreach($assets AS $key => $asset)

                            <x-tables.row altcolor="{{ $loop->odd }}" class="space-y-1">

                                <x-tables.cell class="font-bold align-top uppercase">
                                    <div class="pt-3">{{ $asset->descr ?? '' }}</div>
                                </x-tables.cell>

                                <x-tables.cell class="flex flex-col" >

                                    <div class="flex flex-col space-y-1">
                                        <input type="text" wire:model.defer="editmemberassets.{{ $key }}.pivot.tag"
                                               name="tag"
                                               placeholder="ex. number, size, or text"
                                        />

                                        <div class="grid grid-cols-12 w-full">
                                            <label class="pt-3 col-span-2" title="Assigned">Assg'd</label>
                                            <input wire:model.defer="editmemberassets.{{ $key }}.pivot.date_issued" class="col-span-10" type="datetime-local" name="issued" />
                                        </div>

                                        <div class="grid grid-cols-12">
                                            <label class="pt-3 col-span-2" title="Returned">Ret'd</label>
                                            <input wire:model.defer="editmemberassets.{{ $key }}.pivot.date_returned" type="datetime-local" name="returned" class="col-span-10" />
                                        </div>
                                    </div>

                                </x-tables.cell>

                            </x-tables.row>

                        @endforeach

                    @else

                        <x-tables.row >
                            <x-tables.cell colspan="3" class="text-center text-lg text-gray-900">
                                No ensemble assets found for {{ $ensemble->name }}
                            </x-tables.cell>
                        </x-tables.row>

                        </form>

                    @endif
                </x-slot>
            </x-tables.surgetable>

    <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
                <x-saves.save-message-without-button message="Assets saved" trigger="assets-saved" />
                <x-buttons.button wire:click="saveAssets" type="submit">Update Assets</x-buttons.button>
            </footer>

</div>
