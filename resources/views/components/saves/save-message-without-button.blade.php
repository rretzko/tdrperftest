@props([
'message',
'trigger',
'removed' => false,
])
<div class="font-italic @if($removed) bg-red-100 @else bg-green-200 @endif px-2"
     x-data="{show: false}"
     x-show.transition.duration.500ms="show"
     x-init="@this.on('{{$trigger}}',() => {
        setTimeout(() => { show = false; }, 2500 );
        show = true;
        })"
>
    {{$message}}
</div>
