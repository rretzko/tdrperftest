<div>

    {{-- ADD button --}}
    <div class="flex justify-end mb-2 pr-6">

        <x-buttons.button-add toggle="showeditmodal" />

    </div>

    <table class="overflow-scroll w-11/12">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col"
                class="sr-only px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
                Checkbox
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
                Asset
            </th>
            <th scope="col"
                 class="sr-only px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
                Message
            </th>
            <th scope="col" class="sr-only">
                Edit
            </th>

            <th scope="col" class="sr-only">
                Delete
            </th>
        </tr>
        </thead>
        <tbody>

        @forelse($assets AS $asset)

            <tr class="@if($loop->iteration % 2) bg-yellow-100 @else bg-white @endif">
                <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-900 align-text-top w-1/12">

                    <input wire:model="assettypes"
                           type="checkbox"
                           name="assets[{{ $asset->id }}]"
                           value="{{ $asset->id }}"
                    />
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-text-top text-left w-3/12">
                    {{ ucwords($asset->descr) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400 align-text-top text-left">
                    @if($assetsupdated)
                        @if($ensembleassets->contains($asset) && (! $initialassets->contains($asset))) <span class="text-green-400">added</span> @endif
                        @if((! $ensembleassets->contains($asset)) && $initialassets->contains($asset)) <span class="text-red-300">removed</span> @endif
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400 align-text-top text-left">
                    @can('edit-asset', $asset)
                        <x-buttons.button-edit wire:click="edit({{ $asset->id }})" />
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400 align-text-top text-left">
                    @can('edit-asset', $asset)
                        <x-buttons.button-delete-sure confirmingdelete="{{ $confirmingdelete }}" id="{{ $asset->id }}"/>
                    @endcan
                </td>
            </tr>
        @empty
            <tr><td colspan="3">No assets found</td></tr>
        @endforelse

        </tbody>
    </table>

    {{-- MODALS --}}
    {{-- ADD/EDIT STUDENT --}}
    <div>
        @if($showeditmodal)
            <x-modals.addasset :ensemble="$ensemble" :schoolyear="$schoolyear"  :editasset="$editasset" editmodelname="$editassetdescr"/>
        @endif
    </div>

</div>
