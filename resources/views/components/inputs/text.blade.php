@props([
    'currentvalue' => '',
    'label',
    'for',
    'initialfocus' => "0",
    'immediate' => false,
    'required' => false,
])
<div class="mb-2">
    <label for="{{ $for }}" class="block text-sm font-medium text-gray-700">{{ ucwords($label) }}</label>
    <div class="mt-1 relative rounded-md shadow-sm">
        <input @if($immediate) wire:model={{ $for }} @else wire:model.lazy={{ $for }} @endif type="text" name="{{ $for }}" id="{{ $for }}"
               @if($required) required @endif
               class="block w-full pr-10 @if($errors->first($for)) border-red-300 text-red-900 placeholder-red-300 @endif focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
               value="{{ strlen(old($for)) ? old($for) : (strlen($currentvalue) ? $currentvalue : '') }}"
               {{ $attributes }}
               aria-invalid="true" aria-describedby="email-error" @if($initialfocus) autofocus @endif >
    </div>
    @error($for)
        <p class="mt-2 text-sm text-red-600" id="{{ $for }}-error">
            {{ $message }}
        </p>
    @enderror
</div>


