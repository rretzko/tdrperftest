<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 flex flex-row">
<!-- {{--
            @if($teachers->count())
                <x-impersonationbar/>
            @endif
--}} -->
            <div>

                <x-livewire-table-with-modal-forms>

                    <x-slot name="title">
                        {{ __('Site Administration') }}
                    </x-slot>

                    <x-slot name="description">

                        <x-sidebar-blurb blurb="Tools for Site Administration"/>

                    </x-slot>

                    <x-slot name="table">
                        <div class=" flex flex-wrap space-x-2 space-y-1 align-top">

                            @livewire('siteadministration.siteadministrator')

                        </div>

                        <div>
                            <a href="{{ route('siteadministrator.emailsdump') }}">
                                <button style="background-color: yellow; color: darkblue; padding: 0 0.5rem;">
                                    Subscriber Email dumps
                                </button>
                            </a>
                        </div>

                        <div>
                            <a href="{{ route('siteadministrator.emailsdump',['offset' => 1,'length'=> 3000]) }}">
                                <button style="background-color: yellow; color: darkblue; padding: 0 0.5rem;">
                                    NonSubscriber Email dumps 1-3000
                                </button>
                            </a>
                        </div>

                        <div>
                            <a href="{{ route('siteadministrator.emailsdump',['offset' => 3001,'length'=> 3000]) }}">
                                <button style="background-color: yellow; color: darkblue; padding: 0 0.5rem;">
                                    NonSubscriber Email dumps 3001-6000
                                </button>
                            </a>
                        </div>

                        <div>
                            <a href="{{ route('siteadministrator.emailsdump',['offset' => 6001,'length'=> 3000]) }}">
                                <button style="background-color: yellow; color: darkblue; padding: 0 0.5rem;">
                                    NonSubscriber Email dumps 6001-9000
                                </button>
                            </a>
                        </div>

                        <div>
                            <a href="{{ route('siteadministrator.emailsdump',['offset' => 9001,'length'=> 3000]) }}">
                                <button style="background-color: yellow; color: darkblue; padding: 0 0.5rem;">
                                    NonSubscriber Email dumps 9001-12000 (or end)
                                </button>
                            </a>
                        </div>


                    </x-slot>

                </x-livewire-table-with-modal-forms>

            </div>

            <div class="bg-white" style="min-width: 25rem; padding: 0.5rem;">
                <header style="margin-top: 1rem; border-bottom: 1px solid darkgrey; font-weight: bold;">
                    Stats
                </header>
                <div>
                    PHP Version: {{ phpversion() }}
                </div>
                <div>
                    Laravel Version: 8.83.6 (as of 01-Jun-22)
                </div>
            </div>

        </div>
    </div>

    <x-jet-section-border />

</x-app-layout>
