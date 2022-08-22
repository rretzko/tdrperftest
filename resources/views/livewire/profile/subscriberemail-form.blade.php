<div>
    <x-jet-form-section submit="save">

        <x-slot name="title">
            {{ __('Update My Emails') }}
        </x-slot>

        <x-slot name="description" >
            {{ __('Update your email address(es).') }}
        </x-slot>

        <x-slot name="form">

            <div class="col-span-6 sm:col-span-4">

                <!-- EMAIL:WORK -->
                <x-jet-label for="email_work" value="{{ __('Work') }}" />
                <span class="font-bold text-red-700">NOTE: This email address will be used for cc: on student emails.</span>
                <x-jet-input wire:model.defer="email_work" id="email_work" type="email" class="mt-1 block w-full"  />
                <x-jet-input-error for="email_work" class="mt-2" />

                <!-- EMAIL:PERSONAL -->
                <x-jet-label for="email_personal" value="{{ __('Personal') }}" />
                <x-jet-input wire:model.defer="email_personal" id="email_personal" type="email" class="mt-1 block w-full" />
                <x-jet-input-error for="email_personal" class="mt-2" />

                <!-- EMAIL:OTHER -->
                <x-jet-label for="email_other" value="{{ __('Other') }}" />
                <x-jet-input wire:model.defer="email_other" id="email_other" type="email" class="mt-1 block w-full" />
                <x-jet-input-error for="email_other" class="mt-2" />

            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-green-success-message :message="$message"/>

            <x-jet-button wire:loading.attr="disabled" wire:target="save">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>

    </x-jet-form-section>
</div>



