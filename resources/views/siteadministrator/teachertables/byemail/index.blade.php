<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div>

                <x-livewire-table-with-modal-forms>

                    <x-slot name="title">
                        {{ __('Site Administration: Teacher Table By Email') }}
                    </x-slot>

                    <x-slot name="description">

                        <x-sidebar-blurb blurb="Tools for Site Administration"/>
                        <x-sidebar-blurb blurb="<a href='{{ route('siteadministration.teachertable.index') }}'>Roster by name</a>" />

                    </x-slot>

                    <x-slot name="table">
                        <div class=" flex flex-wrap space-x-2 space-y-1 align-top">
                            <style>
                                td,th{border: 1px solid black; padding:0 .25rem;}
                            </style>
                            <table>
                                <thead>
                                    <tr>
                                        <th>###</th>
                                        <th>Sys.Id.</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($emails AS $email)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $email->user_id }}</td>
                                            <td>{{ $email->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </x-slot>

                </x-livewire-table-with-modal-forms>

            </div>

        </div>
    </div>

    <x-jet-section-border />

</x-app-layout>
