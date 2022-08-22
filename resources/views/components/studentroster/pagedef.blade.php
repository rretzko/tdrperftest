@props([
'displayhide',
])
<div
    x-data="{
        show: false,
        init() {
            let setting = localStorage.getItem('show-page-def');

            this.show = setting === 'true' || setting == null;

            this.$watch('show', (value) => {
                localStorage.setItem('show-page-def', Boolean(value));
            });
        }
    }"
    x-init="init()"
    :class="{ 'max-h-9': ! show, 'max-h-64': show, }"
    class="transition-all overflow-y-hidden"
>
    {{-- PAGE DEFINITION HEADER --}}
    <div class="h-8 w-full flex items-center justify-between">
        <div class="text-lg font-medium text-gray-900">
            Students <i>(def.)</i>
        </div>

        <div class="flex flex-shrink-0">
            {{-- Heroicons small arrow-narrow-up --}}
            <button
                type="button"
                class="text-gray-500 text-sm px-2 focus:outline-none"
                @click.prevent="show = !show"
                x-text="show ? 'Hide' : 'Display'"
            ></button>
        </div>
    </div>

    <div>
        <div
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <p class="mt-1 text-sm text-gray-500">
                The Students page displays your roster of students, both past and present.
            </p>
            <p class="mt-1 text-sm text-gray-500">
                Click on any student's name to display their detailed information.
            </p>
        </div>
    </div>
</div>
