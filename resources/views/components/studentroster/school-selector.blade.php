@props([
    'schoolid',
    'schools'
])
<div class="mx-4 p-2 text-lg font-medium text-gray-900 bg-white rounded-t bg-gray-200">
    Directory for:
    <select name="schoolid" wire:model="schoolid">
        @foreach($schools AS $key => $value)
            <option value="{{$key}}" >{{$value}}</option>
        @endforeach
    </select>
</div>
