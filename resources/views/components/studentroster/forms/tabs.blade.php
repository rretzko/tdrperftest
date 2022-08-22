@props([
'student',
'tab',
'tabcontent',
])
<div>
    <div class="sm:hidden pt-2">
        <label for="tabs" class="sr-only">Select a tab</label>
        <select wire:model="tab" id="tabs" name="tabs" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
            <option value="biography">Biography</option>

            <option value="profile">Profile</option>

            <option value="instrumentation">Voice & Instrument</option>

            <option value="communication">Email & Phone</option>

            <option value="homeaddress">Home Address</option>

            <option value="guardian">Parent & Guardian</option>
        </select>
    </div>

    <style>
        .tab{
            border-top-right-radius: .75rem;
            border-top-left-radius: .75rem;
            margin-right: .1rem;
        }
        .tabsettings{
            background-color: transparent;
            position: absolute;
            right: 0;
            left: 0;
            bottom: 0;
            height: 0.125rem;
        }
        .tabon{
            --tw-bg-opacity: 1;
            background-color: rgba(251, 191, 36, var(--tw-bg-opacity)); <!-- bg-yellow-400 -->
        }
    </style>
    <div class="hidden sm:block pt-2">
        <nav class="relative z-0  border-b-2 border-gray-200 flex divide-x divide-gray-200 mx-auto" style="max-width:90%;" aria-label="Tabs">

            @if(is_a($student, 'App\Models\Student') && (! $student->user_id))
                <a href="#"
                   wire:click="$set('tab','profile')"
                   class="tab text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10"
                   title="Profile"
                >
                    <div class="flex flex-col">
                        {{-- HEROICON FINGER-PRINT --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                        </svg>
                        <span class="sm:hidden lg:block ml-1 pt-0.5">Profile</span>
                        <span aria-hidden="true" class="tabsettings @if($tab === 'profile') tabon @endif"></span>
                    </div>
                </a>
            @else
                <a href="#"
                    wire:click="$set('tab','biography')"
                    class="tab text-gray-900 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10" aria-current="page"
                    title="Biography"
                >
                    <div class="flex flex-col">
                        {{-- HEROICON IDENTIFICATION --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                        <span class="sm:hidden lg:block ml-1 pt-0.5">Biography</span>
                    </div>
                    <span aria-hidden="true" class="tabsettings @if($tab === 'biography') tabon @endif"></span>
                </a>

                <a href="#"
                    wire:click="$set('tab','profile')"
                    class="tab text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10"
                    title="Profile"
                >
                    <div class="flex flex-col">
                        {{-- HEROICON FINGER-PRINT --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                        </svg>
                        <span class="sm:hidden lg:block ml-1 pt-0.5">Profile</span>
                        <span aria-hidden="true" class="tabsettings @if($tab === 'profile') tabon @endif"></span>
                    </div>
                </a>

                <a href="#"
                    wire:click="$set('tab','instrumentation')"
                    class="tab text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10"
                    title="Voice & Instrument"
                >
                    <div class="flex flex-col">
                        {{-- HEROICON MUSIC-NOTE --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                        <span class="sm:hidden lg:block ml-1 pt-0.5">Voice & Instrument</span>
                        <span aria-hidden="true" class="tabsettings @if($tab === 'instrumentation') tabon @endif"></span>
                    </div>
                </a>

                <a href="#"
                   wire:click="$set('tab','communication')"
                    class="tab text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10"
                    title="Communications"
                >
                    <div class="flex flex-col">
                        {{-- HEROICON MAIL --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="sm:hidden lg:block ml-1 pt-0.5">Email & Phone</span>
                        <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                        <span aria-hidden="true" class="tabsettings @if($tab === 'communication') tabon @endif"></span>
                    </div>
                </a>

                <a href="#"
                    wire:click="$set('tab','homeaddress')"
                    class="tab text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10"
                    title="Home Address"
                >
                    <div class="flex flex-col">
                        {{-- HEROICON HOME --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="sm:hidden lg:block ml-1 pt-0.5">Home Address</span>
                        <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                        <span aria-hidden="true" class="tabsettings @if($tab === 'homeaddress') tabon @endif"></span>
                    </div>
                </a>

                <a href="#"
                    wire:click="$set('tab','guardian')"
                    class="tab text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-sm font-medium text-center hover:bg-gray-50 focus:z-10"
                    title="Parent & Guardian"
                >
                    <div class="flex flex-col">
                        {{-- HEROICON USERS --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="sm:hidden lg:block ml-1 pt-0.5">Parent & Guardian</span>
                        <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                        <span aria-hidden="true" class="tabsettings @if($tab === 'guardian') tabon @endif"></span>
                    </div>
                </a>
            @endif
        </nav>
    </div>
</div>
