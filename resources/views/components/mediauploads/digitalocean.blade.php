@props([
    'filecontenttype,
])

<form action='{{ route('registrant.mediaupload.update') }}'
      method='post'
      enctype='multipart/form-data'
      class="p-3 "
>

    @csrf

    <input type="hidden" name="title"
           value="{{ $filename.$filecontenttype->descr}}.mp3"/>

    <input type="file" name="uploaded_file">
<!-- {{--

--}} -->
    {{-- SAVE BUTTON --}}
<!-- {{--
    <div class="flex justify-end">
        @if($uploadspermitted)
            <input
                class="bg-black text-white border rounded px-4 cursor-pointer"
                type="submit" name="submit"
                value="Upload {{ ucwords($filecontenttype->descr) }}"
            />
        @else
            No uploads permitted at this time
        @endif
    </div>
--}} -->
</form>
