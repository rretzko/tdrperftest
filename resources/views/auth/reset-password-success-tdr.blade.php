<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />


            <div class="block text-center bg-green-100">
                <div>Congratulations!</div>
                <div>
                    Your password has been reset.

                    Please click <a class="text-green-900"
                                    href="https://thedirectorsroom.com/logout/tdr"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        HERE
                    </a>
                    to log into TheDirectorsRoom.com!
                    @if(config('app.url') === 'http://localhost')
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    @else
                        <form id="logout-form" action="https://thedirectorsroom.com/logout" method="POST" style="display: none;">@csrf</form>
                    @endif
                </div>
            </div>


    </x-jet-authentication-card>
</x-guest-layout>
