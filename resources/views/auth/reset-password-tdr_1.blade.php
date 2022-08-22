<x-app-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        @if(config('app.url') === 'http://localhost')
            <form method="POST" action="{{ route('resetpassword.tdr.update') }}">
        @else
            <form method="POST" action="https://thedirectorsroom.com/reset-password/tdr/update">
        @endif

            @csrf
@if(count($errors))
    <div class="text-red-600">
        <ul>
            @foreach($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(count($errors->updatePassword))

    <div class="text-red-600">
        <p>
            Errors were found on your password. Please ensure that your password is at least eight-characters in length
        and includes uppercase, lowercase, numeric and special (@#$%, etc.) characters.
        </p>
        <p>
            Also, the Password and Confirm Password must exactly match.
        </p>
    </div>
@endif

            <input type="hidden" name="token" value="{{ $token }}" />

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>
