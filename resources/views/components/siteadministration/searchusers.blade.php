@props([
'persons',
])
<div>
    <h2 class="font-bold text-lg mb-1">Users</h2>

    <div class="w-12/12">
        <label class="w-6/12" for="search">Search</label>
        <input type="text" wire:model.debounce.500ms="search" placeholder="Enter person's name">
    </div>

    <div class="w-full flex flex-col">
        @if($persons->count())
            <label class="" for="">Results</label>
            <div class="">

                @foreach($persons AS $person)
                    <x-siteadministration.cards.userprofile :person="$person" />
                @endforeach

            </div>
        @endif
    </div>
</div>
