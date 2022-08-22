@props(['id' => null, 'maxWidth' => null, 'options', 'currentvalue' => 0 ])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                </svg>
            </div>

            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg">
                    Ensemble Member .csv file upload...
                </h3>

                <p>
                    The system will automatically upload ensemble members from a .csv file which meets
                    the following criteria:
                    <style>#instructions th{border: 1px solid darkblue; text-align: center; font-size: small; padding: 0 2px;}</style>
                    <ul id="instructions" class="ml-5 list-disc">
                        <li>Six columns as follows:
                            <ol class="ml-5">
                                <li>
                                    <table >
                                        <tr>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Middle name</th>
                                            <th>Ensemble name</th>
                                            <th>Voice part</th>
                                            <th>Grade/ Class</th>
                                        </tr>
                                    </table>
                                </li>
                            </ol>
                        </li>
                        <li>The system will automatically add a new student record UNLESS it finds a match with students
                            in your Student roster.  The system will check the following fields:
                            <ul class="ml-5">
                                <li>First name, last name, school, grade/class</li>
                            </ul>
                        </li>
                        <li>
                            For those students currently on your Student roster, please ensure that the .csv file
                            information <u>exactly matches</u> the information on your Student roster.
                        </li>
                        <li class="space-y-4">
                            <a href="/assets/csvs/ensemblemembers_template.csv"
                               title="Click to download template"
                               class="text-blue-600"
                            >
                                Click here for a template to get you started!
                            </a>
                        </li>
                    </ul>
                </p>

                <form enctype="multipart/form-data" method="post" action="{{ route('ensemblemembers.import') }}">

                    @csrf

                    <x-inputs.group label="School Year" for="schoolyear_id" >
                        <select name="schoolyear_id">
                            @foreach($options AS $option)
                                <option value="{{ $option->id }}"
                                    @if($option->id == $currentvalue) SELECTED @endif
                                >
                                    {{ $option->descr }}
                                </option>
                            @endforeach
                        </select>

                    </x-inputs.group>

                    <x-inputs.group label="Choose file" for="file" >
                        <input type="file" id="csvfile" name="ensemblemembers_csv" accept="text/csv">
                        @error('csvfile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </x-inputs.group>

                    <footer class="mt-4 bg-gray-200 flex justify-end space-x-2 p-2">
                        <x-saves.save-message-without-button message="File uploaded" trigger="ensemblemember-file-uploaded"/>
                        <x-buttons.button type="submit">Upload file</x-buttons.button>
                    </footer>

                </form>
            </div>
        </div>
    </div>
</x-jet-modal>
