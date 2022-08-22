@props([
    'schools',
    'selectedschoolname',
    'students',
    'teachers',
])
<!-- 'selectedschool',


     -->
<style>
    label{margin-right: 1rem;}
</style>
<div>

    <h2 class="font-bold text-lg mb-1">Transfer Current Students</h2>

    <div class="w-12/12">
        <label class="w-6/12" for="search">Schools</label>
        <input type="text" wire:model.debounce.500ms="searchschool" placeholder="Enter school name">
    </div>

    <div class="w-full flex flex-col">
        @if($schools->count())
            <label class="" for="">Results</label>
            <div class="">
                <ul>
                @foreach($schools AS $school)
                        <li>
                            <span wire:click="updateSchool({{ $school->id }})" class="cursor-pointer text-blue-700">
                                {{ $school->name.' ('.$school->city.', '.$school->postalcode.')' }}
                            </span>
                        </li>
                @endforeach
                </ul>
            </div>
        @endif

        <div class="w=full flex flex-col">
            @if(strlen($selectedschoolname))
                <div class="flex flex-row">
                    <label>Selected School</label>
                    <div>
                        <b>{{ $selectedschoolname }}</b>
                    </div>
                </div>
<!-- {{--
                <div class="flex flex-row">
                    @if($teachers->count())
                        <label>Select Teacher</label>
                        <div>
                            <ul>
                            @foreach($teachers AS $teacher)
                                @if($teacher)

                                    <li class="flex flex-row">
                                        <input
                                            wire:click="updateSelectedTeachers({{ $teacher->user_id }})"
                                               class="mr-1"
                                               type="checkbox"
                                        />
                                        <span>{{ $teacher['person']->fullName }}</span>
                                    </li>
                                @endif
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
--}} -->
<!-- {{--
                <div class="flex flex-row">
                    <label>Current Students</label>
                    <ul>
                        @foreach($students AS $student)
                            <li>{{ $student->person->fullNameAlpha.': '.$student->gradeClassof }}</li>
                        @endforeach
                    </ul>
                </div>
--}} -->
<!-- {{--
                <div>
                    <button class="bg-black text-white rounded px-1" wire:model="transferStudents" >Transfer Students</button>
                </div>
--}} -->
                <div>
                    <span class="bg-black text-white rounded px-1" wire:click="transferStudents" >Workaround</span>
                </div>

            @endif
        </div>

    </div>

    </div>

</div>
