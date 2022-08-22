@props([
'users',
])
<div class="bg-gray-100 border border-black rounded p-1 mt-2">
    <h2 class="font-bold text-lg mb-1">Users</h2>

    <div class="w-12/12 mb-2">
        <label class="w-6/12" for="search">Search</label>
        <input type="text" wire:model.debounce.500ms="searchuser" placeholder="Enter username">
    </div>

    <div class="w-full flex flex-col mb-1">
        @if($users->count())
            <label class="" for="">Results</label>
            <div class="">
                <ul>
                @foreach($users AS $user)
                    <li>{{ $user->username }}</li>
                @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div>
        <div class="w-full mb-1">
            <label class="w-3/12">Username</label>
            <input class="w-8/12" type="text" wire:model="resetpasswordusername" />
        </div>
        <div class="w-12/12 mb-1">
            <label class="w-3/12">Password</label>
            <input class="w-8/12" type="text" wire:model="resetpasswordpassword" />
        </div>
        <div class="bg-gray-400 text-black rounded mt-1 text-center cursor-pointer w-6/12">
            <button wire:click="updatePassword" >Update Password</button>
        </div>

    </div>
</div>
