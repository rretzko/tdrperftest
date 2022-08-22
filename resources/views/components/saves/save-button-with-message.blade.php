@props([
'message' => 'Saved',
'trigger' => 'saved-biography',
])
<div class="flex justify-end items-center px-4 py-3 bg-gray-50 text-right sm:px-6 mt-4 space-x-2 ">

    <div class="font-italic bg-green-200 p-2 mr-1"
         x-data="{show: false}"
         x-show.transition.duration.500ms="show"
         x-init="@this.on('{{$trigger}}',() => {
            setTimeout(() => { show = false; }, 2500 );
            show = true;
            })"
    >
        {{$message}}
    </div>

    <x-buttons.button-save />
</div>
