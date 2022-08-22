@props([
'currentvalues' => [],
'label',
'for',
'options',
])

<div class="mt-1 block w-full pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" >
    <label for="">{{ ucwords($label) }}</label>
    <div class=" space-x-2">
        @foreach($options AS $key => $value)
            <input type="checkbox"
               id="{{ $for }}[{{ (is_object($value)) ? $value->id : $key }}]"
               name="{{ $for }}[]"
               value="{{ (is_object($value)) ? $value->id : $key }}"
                {{ in_array(((is_object($value)) ? $value->id : $key), $currentvalues) ? 'CHECKED' : '' }}
            >
            <label for="{{ (is_object($value)) ? $value->id : $key }}">{{ is_object($value) ? ucwords($value->descr) : ucwords($value) }}</label>
        @endforeach
    </div>
    @error($for)
    <p class="mt-2 text-sm text-red-600" id="{{ $for }}-error">
        {{ $message }}
    </p>
    @enderror
</div>

