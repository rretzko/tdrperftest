@props([
'choralinstrumentation',
'classofs',
'displayform',
'geostates',
'heights',
'instrumentalinstrumentation',
'instrumentationbranch_id',
'instrumentationbranches',
'newinstrumentations',
'photo',
'pronouns',
'shirtsizes',
'student',
'tab' => 'biography',
'tabcontent' => false,
])
<div
    x-data="{
        show: {{ $displayform ? 'true' : 'false' }}
    }"
    x-show="show"
    class="w-full md:w-8/12"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 w-0 md:w-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 w-0 md:w-0"
>
    <div
        class="mt-2 bg-blue-50 text-black border border-black border-l-3 border-t-0 border-r-0 px-3"
    >
        <div class="flex justify-end text-xs pt-2 pr-3 ">
            <a href="#" wire:click="$set('displayform',0)" class="text-blue-700">Return to Students table</a>
        </div>

        @if((! is_null($student)) && $student->user_id)

            {{-- NAVIGATION TABS --}}
            <x-studentroster.forms.tabs :tab="$tab" :student="$student" />

            {{-- FORMS DISPLAY LOGIC --}}
            <div>
                @if($tab === 'biography')
                    <x-studentroster.forms.sections.biography :student="$student" :photo="$photo" wire:key="biography" />
                @elseif($tab === 'profile')
                    <x-studentroster.forms.sections.profile
                        :classofs="$classofs"
                        :heights="$heights"
                        :pronouns="$pronouns"
                        :shirtsizes="$shirtsizes"
                        :student="$student"
                        wire:key="profile"
                    />
                @elseif($tab === 'instrumentation')
                    <x-studentroster.forms.sections.instrumentation
                        :choralinstrumentation="$choralinstrumentation"
                        :instrumentalinstrumentation="$instrumentalinstrumentation"
                        :student="$student"
                        wire:key="instrumentation"
                    />
                @elseif($tab === 'communication')
                    <x-studentroster.forms.sections.communication
                        :student="$student"
                        wire:key="communication"
                    />
                @elseif($tab === 'homeaddress')
                    <x-studentroster.forms.sections.homeaddress
                        :geostates="$geostates"
                        :student="$student"
                        wire:key="address"
                    />
                @elseif($tab === 'guardian')
                    <x-studentroster.forms.sections.guardian
                        :student="$student"
                        wire:key="guardian"
                    />
                @else
                    Some other tab: {{$tab}} section here...
                @endif
            </div>
        @else {{-- NEW STUDENT --}}

            {{-- NAVIGATION TABS --}}
            <x-studentroster.forms.tabs :tab="$tab" :student="$student" />

            <x-studentroster.forms.sections.profile
                :classofs="$classofs"
                :heights="$heights"
                :pronouns="$pronouns"
                :shirtsizes="$shirtsizes"
                :student="$student"
            />

        @endif
    </div>
</div>
