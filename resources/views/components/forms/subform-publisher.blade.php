@props([
'geostates'
])

<div class="ml-4">
    <x-inputs.text
        model:wire.lazy="publisheraddress0"
        class="text-xs"
        label=""
        for="publisheraddress0"
        placeholder="address 1..."
    />

    <x-inputs.text
        model:wire.lazy="publisheraddress1"
        label=""
        for="publisheraddress1"
        placeholder="address 2..."
    />

    <x-inputs.text
        model:wire.lazy="publishercity"
        label=""
        for="publishercity"
        placeholder="city..."
    />

    <x-inputs.select
        model:wire.lazy="publishergeostateid"
        label="State"
        for="publishergeostateid"
        :options="$geostates"
    />

    <x-inputs.text
        model:wire.lazy="publisherpostalcode"
        label=""
        for="publisherpostalcode"
        placeholder="zip code..."
    />

    <div class="flex justify-end">

        <x-buttons.button-link wire:click="savepublisher" class="bg-green-200 border-green-800 rounded text-black p-2 hover:bg-green-300">
            Add Publisher
        </x-buttons.button-link>

    </div>
</div>
