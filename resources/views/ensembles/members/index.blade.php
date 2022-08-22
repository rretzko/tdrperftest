<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            @livewire('ensembles.memberscomponent') <!-- calls app\http\livewire\ensembles\Memberscomponent::render() -->

            <x-jet-section-border />

        </div>
    </div>

</x-app-layout>
