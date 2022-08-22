{{-- IMPERSONATION BAR --}}
<div class="relative bg-indigo-600">
    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
        <div class="pr-16 sm:text-center text-white sm:px-16 space-x-3">

            <form method="POST" action="{{ route('impersonation.show') }}">
                @csrf

                <label for="user_id">Impersonate Director</label>
                @if(isset($teachers) && ($teachers->count() !== null))
                    <select name="user_id" class="text-black">
                        @foreach($teachers AS $teacher)
                            <option value="{{ $teacher->user_id }}">{{ $teacher->person->fullNameAlpha }}</option>
                        @endforeach
                    </select>
                @endif
                <x-buttons.button-save />

            </form>

        </div>
        <div class="@if(session()->has('impersonating')) block @else hidden @endif pr-16 sm:text-center sm:px-16">

            <p class="font-medium text-white space-x-3">
                    <span class="hidden md:inline">
                      You are impersonating: {{ auth()->user()->username }}
                    </span>
                <span class="">
                        <a href="#" class="text-yellow-300">Leave Impersonation</a>
                    </span>
            </p>

        </div>
    </div>
</div>
