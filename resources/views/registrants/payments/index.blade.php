<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div>

                <x-livewire-table-with-modal-forms>

                    <x-slot name="title">
                        {{ __($eventversion->name.' Payments') }}
                    </x-slot>

                    <x-slot name="description">

                        <x-sidebar-blurb blurb="Payment roster for: {{ $eventversion->name }}"/>

                    </x-slot>

                    <x-slot name="table">

                        {{-- BACK TO ROSTER --}}
                        <div class="flex text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 20 20"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <a href="{{ route('registrants.index',['eventversion' => $eventversion]) }}"
                               class="text-red-700 ml-2 pb-4">
                                Return to Registrant Roster
                            </a>
                        </div>

                        {{-- PAYMENT DETAILS --}}
                        <div class="flex overflow-x-auto ">
                            {{-- PAYMENT ROSTER TABLE--}}
                            <section>
                                <x-payments.table
                                    :registrants="$registrants"
                                    :eventversion="$eventversion"
                                />

                            </section>

                            {{-- PAYMENT FORM --}}
                            <section class="ml-4">
                                <x-payments.form
                                    :eventversion="$eventversion"
                                    :payer="$payer"
                                    :paymenttypes="$paymenttypes"
                                />
                            </section>
                        </div>

                    </x-slot>

                </x-livewire-table-with-modal-forms>

            </div>

        </div>
    </div>

    <x-jet-section-border />

</x-app-layout>
