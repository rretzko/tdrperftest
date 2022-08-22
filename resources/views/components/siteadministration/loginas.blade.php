@props([
'loginas',
])
<div>
    <h2 class="font-bold text-lg mb-1">Log In As</h2>

    <div class="w-12/12">
        <label class="w-6/12" for="search">Search</label>
        <input type="text" wire:model.debounce.500ms="searchloginas" placeholder="Enter person's name">
    </div>

    <div class="w-full flex flex-col">
        @if($loginas->count())
            <label class="" for="">Results</label>
            <div class="">
                <ul>
                @foreach($loginas AS $person)
                        <li>
                            @if(config('app.url') === 'http://localhost')
                                <form action="{{ route('impersonate.login', [$person->user_id]) }}" method="post">
                            @else
                                <form action="https://thedirectorsroom.com/impersonation/{{ $person->user_id }}" method="post">
                            @endif
                                @csrf
                                <button class="bg-gray-400 text-black px-2 rounded" type="submit">
                                    Impersonate {{ $person->fullName.' ('.$person->user_id.')' }}
                                </button>
                            </form>
                            <!-- {{-- <span wire:click="switchLogin({{ $person->user_id }})"
                                class="cursor-pointer"
                            >
                                {{ $person->fullnameAlpha.' ('.$person->user_id.')' }}
                            </span> --}} -->
                        </li>
                @endforeach
                </ul>

            </div>
        @endif
    </div>
</div>
