@props([
    'displayform',
    'students',
    'teacher',
])
<div
    x-data="{
        show: {{ $displayform ? 'true' : 'false' }}
    }"
    :class="{ 'md:w-4/12': show }"
    class="w-full flex-1 transition-all"
>
    <div class="overflow-x-auto">
        <div class="py-2 inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 ">
                {{-- SIMPLE TABLE OF STUDENT NAMES WITH STUDENT FORM DISPLAYED --}}
                <table x-show="show" class="min-w-full divide-y divide-gray-200 ">
                    <thead class="bg-gray-50">
                        <tr >
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students AS $student)
                            <tr class="{{ ($loop->iteration % 2) ? 'bg-yellow-50' : 'bg-white' }} ">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="#" wire:click="editStudentForm({{$student->user_id}})" class="text-indigo-600 hover:text-indigo-900">
                                                {{$student->person->fullNameAlpha ?? 'null_object'}}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>No students found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- TABLE WITHOUT STUDENT FORM DISPLAYED.  MINIMIZED FOR SMALL MOBILE FORMAT AND FULL AT MEDIUM SIZE --}}
                <table x-show="! show" class="min-w-full divide-y divide-gray-200" >
                    <thead class="bg-gray-50">
                        <tr >
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                <span>Name<br />
                                    <span class="hidden md:table-cell">
                                        <!-- {{-- {{$displayform ? '' : "Class | B'day | Height | Shirt Size"}} --}} -->
                                        Class | B'day | Height | Shirt Size
                                    </span>
                                </span>
                            </th>

                            <!-- {{-- <th scope="col" class="{{$displayform ? 'hidden' : ' px-6 py-3 text-left text-xs text-gray-500 uppercase  tracking-wider'}}"> --}} -->
                            <th scope="col" class="hidden md:table-cell px-6 py-3 text-left text-xs text-gray-500 uppercase  tracking-wider">
                                Contact
                            </th>

                            <!-- {{-- <th scope="col" class="{{$displayform ? 'hidden' : 'hidden lg:table-cell px-6 py-3 text-center text-xs text-gray-500 uppercase  tracking-wider'}}"> --}} -->
                            <th scope="col" class="hidden md:table-cell px-6 py-3 text-center text-xs text-gray-500 uppercase  tracking-wider">
                                Status
                            </th>

                            <th scope="col" class=" relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>

                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                    @forelse($students AS $student)
                        <tr class=" {{ ($loop->iteration % 2) ? 'bg-yellow-50' : '' }} ">
                            <td class="pl-1 py-4 whitespace-nowrap align-top">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-9 ">

                                        @if($student->person->user->profile_photo_path)
                                            <img class="h-10 w-10 rounded-full"
                                                    src="{{ '/storage/'.$student->person->user->profile_photo_path }}"
                                                    alt="Profile image">
                                        @else
                                            <svg class='h-full w-full text-gray-300 rounded-full' fill='currentColor'
                                                    viewBox='0 0 24 24'>
                                                <path
                                                    d='M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z'/>
                                            </svg>
                                        @endif

                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$student->person->fullNameAlpha ?? 'null_object'}}
                                        </div>

                                        <div class="hidden md:table-cell text-sm text-gray-500">
                                            {{$student->classof}} ({{$student->grade}}) | {{$student->fbirthday}} |  {{$student->heightFootInch}} | {{$student->shirtsize->abbr}}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- {{-- <td class="{{$displayform ? 'hidden' : ' px-6 py-4 whitespace-nowrap'}}"> --}} -->
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap'}}">
                                {{-- EMAILS --}}
                                @forelse($student->nonsubscriberemails AS $email)
                                    <div class="text-sm">
                                        <a class="text-blue-700"
                                            href="mailto:{{$email->email}}?subject=From {{ $teacher->person->honorific->abbr }} {{$teacher->person->last}}&body=Hi, {{$student->person->first}}"
                                        >
                                            {{$email->email}}</a>
                                    </div>

                                @empty

                                    <div class="text-sm">
                                        No emails found
                                    </div>

                                @endforelse

                                {{-- PHONES --}}
                                @forelse($student->phones AS $phone)
                                    <div class="text-sm">
                                        <div class="text-sm text-gray-500">{{ $phone->phone }} ({{ (strpos($phone->phonetype->descr,'home')) ? 'h' : 'c' }})</div>
                                    </div>

                                @empty
                                        <div class="text-sm">
                                            <div class="text-sm text-gray-500">No phones found</div>
                                        </div>

                                @endforelse

                            </td>
                            <!-- {{-- <td class="{{$displayform ? 'hidden' : 'hidden lg:table-cell px-6 py-4 whitespace-nowrap'}}"> --}} -->
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $student->status === 'alum' ? 'bg-indigo-100 text-indigo-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $student->status }}
                                </span>
                            </td>
                            <td class="w-6/12 px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" wire:click="editStudentForm({{$student->user_id}})" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td :colspan="show ? '2' : '5'" class="text-center text-gray-500">No students found {{$students->count()}}</td></tr>
                    @endforelse

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
