<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-white space-y-2">

            <x-libraries.radioselector :library="$library" :libraries="$libraries" />

            <x-libraries.librarymediatypes
                :librarymediatypes="$librarymediatypes"
                librarymediatypeid="{{ $librarymediatype_id }}"
            />

            @livewire('libraries.compilations.compilationcomponent')

        </div>
    </div>

</x-app-layout>
