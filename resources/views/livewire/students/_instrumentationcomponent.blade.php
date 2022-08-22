<div>
    Instrumentation for {{ $student->person->fullName }}

    <x-inputs.group label="Instrumentations" for="instrumentation_id">
        <div class="flex flex-col space-y-2">
            @if($studentinstrumentations->count())
                <div class="grid-cols-12">
                    @foreach($studentinstrumentations AS $key => $studentinstrumentation)
                        <div class="flex flex-row space-x-2 ">
                            <div>
                                {!! ucwords($studentinstrumentation->instrumentationbranch->descr).':<b>'.$studentinstrumentation->formattedDescr().'</b>' !!}
                            </div>

                            <div >
                                <x-buttons.button-delete id="{{ $studentinstrumentation->id }}"/>
                            </div>

                            @if(! $key) {{-- Display 'Add' button on the first line only --}}
                                <div >
                                    <x-buttons.button-add-icon toggle="addinstrumentation" rotate="{{$addinstrumentation}}"/>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            @if((! $studentinstrumentations->count()) || $addinstrumentation)
                    <form wire:submit.prevent="save">
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
