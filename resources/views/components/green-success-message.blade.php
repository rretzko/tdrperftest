<div class="font-italic bg-green-200 px-2 mr-2"
     x-data="{show: false}"
     x-show.transition.opacity.out.duration.1500ms="show"
     x-init="@this.on('saved',() => { show = true; setTimeout(() => { show = false; }, 2000 )})"
     style="display: none" >
    {{ $message }}
</div>
