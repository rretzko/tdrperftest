@props([
'display_hide'
])
<div class="bg-white w-10/12 mx-auto border rounded p-2 ">
    <div class="" ><!-- -ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap bg-green-200 max-w-md  -->
        <div class="flex justify-between" ><!-- ml-4 mt-4 bg-white  -->
            <div class="text-lg leading-6 font-medium text-gray-900">
                Students <i>(def.)</i>
            </div>
            <div class=" flex flex-shrink-0 ">
                <!-- Heroicons small arrow-narrow-up -->
                <button type="button" wire:click="$toggle('display_hide')" class="text-gray-500 text-sm "><!-- relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 -->
                    {{ $display_hide ? 'Display' : 'Hide' }}
                </button>
            </div>
        </div>

        @if($display_hide)
            <div>
                <p class="mt-1 text-sm text-gray-500">
                    The Students page displays your roster of students, both past and present.
                </p>
                <p class="mt-1 text-sm text-gray-500">
                    Click on any student's name to display their detailed information.
                </p>
            </div>
        @endif

    </div>
</div>
