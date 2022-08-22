@props([
'eventversion',
'payer',
'paymenttypes'
])

<div class="border border-black {{ ($payer && $payer->id) ? 'block' : 'hidden'}}" >
    <header class="bg-gray-200 text-center font-bold">Add Payment</header>
    @if(config('app.url') === 'http://localhost')
        <form method="post" action="{{ route('registrant.payments.store') }}" class="px-2 pb-3">
    @else
        <form method="post" action="https://thedirectorsroom.com/registrant/payment/new" class="px-2 pb-3">
    @endif

        @csrf

        <input type="hidden" name="registrant_id" value="{{ $payer->id }}" />
        <input type="hidden" name="payment_id" value="0" />

        <x-inputs.group for="none" label="" inline="true" borderless="true">
            @if($payer && $payer->id)
               <span class="font-bold bg-green-100 px-4"> For: {{ $payer->student->person->fullNameAlpha }}</span>
            @endif
        </x-inputs.group>

        <x-inputs.group for="payment_id" label="Payment type" inline="true" borderless="true">
            <select name="paymenttype_id">
                @foreach($paymenttypes AS $paymenttype)
                    <option value="{{ $paymenttype->id }}">{{ $paymenttype->descr }}</option>
                @endforeach
            </select>
        </x-inputs.group>

        <x-inputs.group for="amount" label="Amount" inline="true" borderless="true">
            <input type="number" name="amount" value="{{ $eventversion->eventversionconfigs->registrationfee }}" />
        </x-inputs.group>

        <x-inputs.group for="vendor_id" label="Comments/Check #/etc." inline="true" borderless="true">
            <input type="text" name="vendor_id" value="" />
        </x-inputs.group>

        <x-inputs.group for="none" label="" inline="true" borderless="true">
            <input class="bg-black text-white px-4 rounded"
                   type="submit" name="submit" value="Submit"
            />
        </x-inputs.group>

    </form>
</div>
