@props([
'currentid',
'schools',
])
<div>
    <div class="flex justify-around my-4 bg-blue-100 border border-blue-400">
        <label>Select School:</label>
        @foreach($schools AS $school)
            <div>
                <input wire:click="changeSchool({{ $school->id }})"
                       type="radio"
                       class="mr-1"
                       @if($school->id == $currentid) CHECKED @endif
                >
                {{ $school->shortName }}
            </div>
        @endforeach
    </div>
</div>
