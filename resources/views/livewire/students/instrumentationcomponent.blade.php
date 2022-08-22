<div>
    Instrumentation for {{ $student->person->fullName }}

    <x-inputs.group class="w-full" label="Instrumentations" for="instrumentation_id">

            @if($studentinstrumentations->count())
                <table class="w-full">
                    <tbody>
                    @foreach($studentinstrumentations AS $key => $studentinstrumentation)
                        <tr>
                            <td>
                                {{ ucwords($studentinstrumentation->instrumentationbranch->descr) }}
                            </td>

                            <th>
                                {{ $studentinstrumentation->formattedDescr() }}
                            </th>

                            <td>
                                <x-buttons.button-delete id="{{ $studentinstrumentation->id }}"/>
                            </td>

                            @if(! $key) {{-- Display 'Add' button on the first line only --}}
                                <td>
                                    <x-buttons.button-add-icon toggle="addinstrumentation" rotate="{{$addinstrumentation}}"/>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @endif

            @if((! $studentinstrumentations->count()) || $addinstrumentation)
                    <form wire:submit.prevent="save" class="mt-2">
                        <div class="flex flex-row space-x-2">
                            <div>
                                <select wire:model="branch_id">
                                    @foreach($branches AS $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->descr }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-inputs.select label=""
                                     for="instrumentation_id"
                                     :options="$instrumentations"
                                     key="instrumentation1"
                                     currentvalue=""
                                />
                            </div>
                        </div>

                        <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
                            <x-saves.save-message-without-button message="Instrumentation updated"
                                                                 trigger="instrumentation-saved"/>
                            <x-buttons.button type="submit" wire:click="save">
                                Update {{ ucwords($student->person->fullname) }}</x-buttons.button>
                        </footer>
                    </form>
            @endif
        </div>
    </x-inputs.group>
</div>
