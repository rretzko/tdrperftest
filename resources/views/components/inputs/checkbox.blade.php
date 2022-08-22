@props([
'label' => '',
'for',
'defer' => false,
])
<div>
    <label for="{{ $for }}" class="block text-sm font-medium text-gray-700">{{ ucwords($label) }}</label>
    <div class="mt-1 relative rounded-md shadow-sm">
        <input @if($defer) wire:model.debounce.500ms={{ $for }} @else wire:model="{{ $for }}" @endif type="checkbox" name="{{ $for }}" id="{{ $for }}" {{ $attributes }}
               class="block w-full pr-10 @if($errors->first($for)) border-red-300 text-red-900 placeholder-red-300 @endif focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
               aria-invalid="true" aria-describedby="email-error">
    </div>
</div>
