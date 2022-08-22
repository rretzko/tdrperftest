@props([
'currentvalue' => 0,
'displayproperty' => 'descr',
'immediate' => false,
'key' => false,
'label',
'for',
'options',
'placeholder' => ""
])
{{-- @todo determine how to pass a method to displayproperty so that Instrumentation->formattedDescr() can be used in place of Instrumentation->descr --}}
<div >
    <label for="{{ $for }}" class="block text-sm font-medium text-gray-700"></label>
    <select @if($immediate) wire:model @else wire:model.defer @endif ="{{ $for }}" id="{{ $for }}" key="{{ $for }}" name="{{ $for }}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" key="$key">

        @if($placeholder)
            <option value="0"  >{{ $placeholder }}</option>
        @endif

        @foreach($options AS $key => $value)
            <option
                value="{{ (is_object($value)) ? $value->id : $key }}"
            >
                {{ is_object($value) ? $value->$displayproperty : $value }}

            </option>
        @endforeach
        @error($for)
        <p class="mt-2 text-sm text-red-600" id="{{ $for }}-error">
            {{ $message }}
        </p>
        @enderror

    </select>
</div>
