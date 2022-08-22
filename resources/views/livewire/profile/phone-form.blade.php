<div>
    <x-jet-form-section submit="save">

        <x-slot name="title">
            {{ __('Update My Phone Numbers') }}
        </x-slot>

        <x-slot name="description" >
            {{ __('Update your phone number(s).') }}
        </x-slot>

        <x-slot name="form">

            <div class="col-span-6 sm:col-span-4">

                <!-- PHONE:MOBILE -->
                <x-jet-label for="phone_mobile" value="{{ __('Cell/Mobile') }}" />
                <x-jet-input wire:model.defer="phone_mobile" id="phone_mobile" type="text" class="mt-1 block w-full" placeholder="...including area code" />
                <x-jet-input-error for="phone_mobile" class="mt-2" />

                <!-- PHONE:WORK -->
                <x-jet-label for="phone_work" value="{{ __('Work') }}" />
                <x-jet-input wire:model.defer="phone_work" id="phone_work" type="text" class="mt-1 block w-full" placeholder="...including area code" />
                <x-jet-input-error for="phone_work" class="mt-2" />

                <!-- PHONE:HOME -->
                <x-jet-label for="phone_home" value="{{ __('Home') }}" />
                <x-jet-input wire:model.defer="phone_home" id="phone_home" type="text" class="mt-1 block w-full" placeholder="...including area code" />
                <x-jet-input-error for="phone_home" class="mt-2" />

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
</div>




