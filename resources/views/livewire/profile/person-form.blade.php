<x-jet-form-section submit="save">

    <x-slot name="title">
        {{ __('Update My Personal Information') }}
    </x-slot>

    <x-slot name="description" >
        {{ __('Update your names and preferences.') }}
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">

            <!-- TITLE -->
            <x-jet-label for="honorific_id" value="{{ __('Title') }}" />
                <select wire:model.defer="honorific_id" class="mt-1 block w-full" >
                    @foreach($honorifics AS $item)
                        <option
                            value="{{ $item->id }}"
                            @if($honorific_id == $item->id) SELECTED @endif
                        >
                            {{ $item->descr.' ('.$item->abbr.')' }}
                        </option>
                    @endforeach
                </select>

            <!-- NAME -->
            <x-jet-label for="first" value="{{ __('Names') }}" />
            <x-jet-input wire:model.defer="first" id="first" type="text" class="mt-1 block w-full"
                         placeholder="First"
            />
            <x-jet-input-error for="first" class="mt-2" />

            <x-jet-input wire:model.defer="middle" id="middle" type="text" class="mt-1 block w-full"
                         placeholder="Middle"
            />

            <x-jet-input wire:model.defer="last" id="last" type="text" class="mt-1 block w-full"
                         placeholder="Last"
            />
            <x-jet-input-error for="last_name" class="mt-2" />

            <!-- PREFERRED PRONOUN -->
            <x-jet-label for="pronoun_id" value="{{ __('Preferred Pronoun') }}" />
            <select wire:model.defer="pronoun_id" class="mt-1 block w-full">
                @foreach($pronouns AS $item)
                    <option
                        value="{{ $item->id }}"
                        @if($pronoun_id == $item->id) SELECTED @endif
                    >
                        {{ $item->descr }}
                    </option>
                @endforeach
            </select>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-green-success-message :message="$message" />

        <x-jet-button wire:loading.attr="disabled" wire:target="save">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>



</x-jet-form-section>

