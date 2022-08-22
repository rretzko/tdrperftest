
<div wire:model="navigation-user" class="flex flex-row justify-end pr-8" >

    <div class="flex flex-col w-4/12 sm:w-2/12 lg:w-1/12">
        <button  wire:click="toggleItems()"
                 class=" focus:outline-none shadow cursor-pointer text-white hover:text-yellow "
                 style="width: 6rem;"
        >

            <div class="flex flex-row text-white justify-center">
                <!-- DISPLAY A PHOTO AS LINK IF PHOTO IS AVAILABLE -->
                @if(auth()->user()->profile_photo_path)

                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->username }}" class="rounded-full h-10 w-10 object-cover">

                @else
                    <!-- Hericons chevron-down -->
                    @if($navigation_user)
                        <!-- Heroicons chevron-up -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 text-white"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <!-- Hericons chevron-down -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 text-white"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    @endif
                    {{ auth()->user()->username }}
                @endif
            </div>

        </button>

        <ul
            class="@if($navigation_user) display:block @else hidden @endif
                w-6/12 lg:w-9/12 my-2 ml-4 shadow rounded py-1 pl-2 bg-white bg-opacity-10 text-sm ml-auto"
            x-transition:enter="transition-transform transition-opacity ease-out duration-600"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-end="opacity-0 transform -translate-y-3"
        >
            <li class="hover:bg-gray-600">
                <a href="{{ route('profile.show') }}" >Profile</a>
            </li>
            <li class="hover:bg-gray-600">
                <a href="mailto:rick@mfrholdings.com?subject=TDR Support&body=Hey Rick, I've got a question: " >Support</a>
            </li>
            <li class="hover:bg-gray-600"> <a href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log out
                </a>

                @if(config('app.url') === 'http://localhost')
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                @else
                    <form id="logout-form" action="https://thedirectorsroom.com/logout" method="POST" style="display: none;">@csrf</form>
                @endif

            </li>
            @if(auth()->id() === 368)
                <li>
                    <a href="{{ route('siteadministrator.index') }}" class="text-white">Site Admin</a>
                </li>
            @endif
        </ul>

    </div>

</div>
