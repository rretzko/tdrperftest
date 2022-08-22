@props([
'student',
'tab',
])
<div>
    <x-modals.confirmation wire:model="showstudentmodal">

        <x-slot name="title">
            @if($student && $student->user_id)
                Edit {{ $student->person->fullName }}
            @else
                Add New Student
            @endif
        </x-slot>

        <x-slot name="content">

            <x-tabs.studenttabs :student="$student" tab="{{ $tab }}" />

            @if($student && $student->user_id)
                @if($tab === 'biography') @livewire('students.biographycomponent', ['user' => $student->person->user]) @endif
                @if($tab === 'communication') @livewire('students.communicationcomponent', ['student' => $student]) @endif
                @if($tab === 'guardian') @livewire('students.guardiancomponent', ['student' => $student]) @endif
                @if($tab === 'homeaddress') @livewire('students.homeaddresscomponent', ['student' => $student]) @endif
                @if($tab === 'instrumentation') @livewire('students.instrumentationcomponent', ['student' => $student]) @endif
                @if($tab === 'profile') @livewire('students.profilecomponent', ['student' => $student]) @endif
            @else
                @livewire('students.profilecomponent', ['student' => $student])
            @endif

        </x-slot>

        <x-slot name="footer" >
            <x-buttons.secondary wire:click="$toggle('showstudentmodal', false)">Cancel</x-buttons.secondary>
        </x-slot>

    </x-modals.confirmation>
</div>
