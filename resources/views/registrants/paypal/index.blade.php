<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div>

                <x-livewire-table-with-modal-forms>

                    <x-slot name="title">
                        {{ __('Pay via PayPal') }}
                    </x-slot>

                    <x-slot name="description">

                        <x-sidebar-blurb blurb="Process the Estimate for payment via PayPal"/>

                    </x-slot>

                    <x-slot name="table">

                        <div class="flex justify-between">
                            {{-- BACK TO ROSTER --}}
                            <div class="flex text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 20 20"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                <a href="{{ route('registrant.estimateform',['eventversion' => $eventversion]) }}"
                                   class="text-red-700 ml-2 pb-4">
                                    Return to Estimate Form
                                </a>
                            </div>

                        </div>

                        {{-- ESTIMATE FORM --}}
                        <div class="my-2 overflow-x-auto sm:mx-2 lg:mx-2">

                            {{-- BANNER --}}
                            <header class="">

                                <div class="flex flex-col">
                                    <div class="uppercase text-center">
                                        STUDENT ESTIMATE FORM
                                    </div>

                                    <div class="uppercase border-b text-center">
                                        {{ $eventversion->name }}
                                    </div>

                                </div>
                            </header>

                            {{-- DIRECTORS INFORMATION --}}
                            <style>
                                label{width: 10rem;}
                                .data{font-weight: bold;}
                                .input-group{display: flex; flex-direction: row;}
                            </style>
                            <div class="mb-3">
                                <h4 class="text-center data">Director's Information</h4>

                                <div class="input-group">
                                    <label for="">Name:</label>
                                    <span class="data">{{ auth()->user()->person->fullName }}</span>
                                </div>
                                <div class="input-group">
                                    <label for="">School:</label>
                                    <span class="data">{{ $school->name }}</span>
                                </div>
                                <div class="input-group">
                                    <label for="">School Address:</label>
                                    <span class="data">{{ $school->mailingAddress }}</span>
                                </div>
                                <div class="input-group">
                                    <label for="">Director email:</label>
                                    <span class="data">{!! auth()->user()->person->subscriberemailsStacked !!}</span>
                                </div>
                                <div class="input-group">
                                    <label for="">Director Phone(s):</label>
                                    <span class="data">{{ auth()->user()->person->subscriberPhoneCsv }}</span>
                                </div>
                            </div>


                            {{-- REGISTRANT ROSTER --}}
                            <div class="flex flex-col">

                                {{-- HEADER --}}
                  <!-- {{--
                                <h2 class="text-center w-full border-b">
                                    {{ $eventversion->eventversionconfigs->max_count }} STUDENTS MAXIMUM
                                </h2>

                                <h3 class="text-center w-full border-b" style="color: darkred; font-weight: bold;">
                                    YOUR REGISTERED STUDENTS WILL BE AUTOMATICALLY DISPLAYED BELOW.<br />
                                    HANDWRITTEN ENTRIES WILL <u>NOT</u> BE ACCEPTED.
                                </h3>
--}} -->
                                {{-- ROSTER TABLE --}}
                                <style>
                                    table{border-collapse: collapse;}
                                    td,th{border: 1px solid black; padding: 0 .25rem;}
                                </style>
                                <table class="mb-4">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>PayPal</th>
                                        <th>Overpayment</th>
                                        <th>Due</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i=0;$i<$registrants->count();$i++)
                                        @if(isset($registrants[$i]))
                                            <tr>
                                                <td class="text-center">{{ ($i + 1) }}</td>
                                                <td class="">{{ $registrants[$i]->student->person->fullNameAlpha }}</td>
                                                <td class="text-center">${{ number_format($paypalregister->registrationfeePaidByRegistrant($registrants[$i],2)) }}</td>
                                                <td class="text-center">${{ number_format($paypalregister->overpaymentByRegistrant($registrants[$i]),2) }}</td>
                                                <td class="text-center">${{ number_format($paypalregister->registrationfeeDueByRegistrant($eventversion, $registrants[$i]),2) }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="text-center">{{ ($i + 1) }}</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center">${{ $eventversion->eventversionconfigs->registrationfee * ($i + 1) }}</td>
                                            </tr>
                                        @endif

                                    @endfor
                                    </tbody>
                                </table>

                                {{-- RECONCILIATION --}}
                                <div id="reconciliation" class="m-auto border border-black p-4 mb-6">
                                    <div class="flex flex-row">
                                        <label for="">Total Amount Due</label>
                                        <div>${{ number_format($amountduegross,2) }}</div>
                                    </div>
                                    <div class="flex flex-row">
                                        <label for="">PayPal Collected</label>
                                        <div>${{ number_format($paypalcollected,2) }}</div>
                                    </div>
                                    <div class="flex flex-row font-bold">
                                        <label for="">Final Amount Due</label>
                                        <div>${{ number_format($amountduenet,2) }}</div>
                                    </div>
                                </div>

                                {{-- PAYPAL BUTTONS --}}
                                @if($amountduenet)
                                    <div id="paypal-button-container"></div>
                                    <div id="smart-button-container">
                                        <div style="text-align: center;">
                                            <div id="paypal-button-container"></div>
                                        </div>
                                    </div>
                                    <script src="https://www.paypal.com/sdk/js?client-id=ASQ0S-J8FN0jLmw3GBj4GarsKfa_0-36zIj9NJbaey_FBN0NXMIfl-b1APAoBlo99hqS_ZhDns3Tg6ZB&components=buttons,funding-eligibility"></script>
                                    <script>
                                        var FUNDING_SOURCES = [
                                            paypal.FUNDING.CREDIT //,
                                            // paypal.FUNDING.PAYPAL,
                                            //paypal.FUNDING.CARD
                                        ];
                                        // Loop over each funding source/payment method
                                        FUNDING_SOURCES.forEach(function(fundingSource) {

                                            // Initialize the buttons
                                            var button = paypal.Buttons({
                                                fundingSource: fundingSource
                                            });

                                            // Check if the button is eligible
                                            if (button.isEligible()) {

                                                // Render the standalone button for that funding source
                                                button.render('#paypal-button-container');
                                            }
                                        });

                                        function initPayPalButton() {
                                            paypal.Buttons({
                                                style: {
                                                    shape: 'pill',
                                                    color: 'blue',
                                                    layout: 'vertical',
                                                    label: 'paypal',

                                                },

                                                createOrder: function(data, actions) {
                                                    return actions.order.create({
                                                        purchase_units: [{"description":"SJCDA 2022 Events: {{ $school->name }}: {{ auth()->user()->person->fullname }}","amount":{"currency_code":"USD","value":{{ number_format($amountduenet,2) }}}}]
                                                    });
                                                },

                                                onApprove: function(data, actions) {
                                                    return actions.order.capture().then(function(details) {
                                                        alert('Transaction completed by ' + details.payer.name.given_name + '!');
                                                    });
                                                },

                                                onError: function(err) {
                                                    console.log(err);
                                                }
                                            }).render('#paypal-button-container');
                                        }
                                        initPayPalButton();
                                    </script>
                                @endif

                            </div>

                        </div>

                    </x-slot>

                </x-livewire-table-with-modal-forms>

            </div>

        </div>
    </div>

    <x-jet-section-border />

</x-app-layout>

