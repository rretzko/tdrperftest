<x-app-layout><!-- app/view/components/AppLayout.php calling resources/views/layouts/app.blade.php -->

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div>

                <x-livewire-table-with-modal-forms>

                    <x-slot name="title">
                        {{ __('Dashboard') }}
                    </x-slot>

                    <x-slot name="description">

                        <x-sidebar-blurb blurb="The Dashboard will contain various tabular, graphic and linked data
                            for your general use."/>
                        @if($gettingstarted)
                            <x-dashboard.gettingstarted />
                        @else
                            <div id="gettingStartedBlock" style="display: none; visibility: hidden;">
                                <x-dashboard.gettingstarted gettingstarted="{{$gettingstarted}}"/>
                            </div>

                            <div id="gettingStartedToggle">
                                <input type="checkbox"
                                       name="gettingstartedcheckbox"
                                       id="gettingstartedcheckbox"
                                       value="1"
                                       onclick="toggleGettingStarted()"/>
                                <label  class="text-white text-xs" for="gettingstarted">Please show the 'Getting Started' advice again!</label>
                            </div>
                        @endif

                    </x-slot>

                    <x-slot name="table">
                        <div class=" flex flex-wrap space-x-2 space-y-1 align-top">
                            <style>
                                .dashboardcard{}
                                .dashboardcard header{background-color: lightgray; border: 1px solid black;text-align: center;font-weight: bold;}
                                .dashboardcard .dashboardbody{border: 1px solid black; padding:0 .25rem;}
                            </style>
                            <x-dashboard.countstudents :dashboard="$dashboard" />
                            <x-dashboard.schoollist :dashboard="$dashboard" />
                            <x-dashboard.orientation />
                            <x-dashboard.eventversiondocs />

                        </div>
                    </x-slot>

                </x-livewire-table-with-modal-forms>

            </div>

        </div>
    </div>

    <script>
        var $toggle=false;

        function toggleGettingStarted() {

            if ($toggle){ //gettingStartedBlock is displayed
                document.getElementById('gettingStartedBlock').style.display = "none";
                document.getElementById('gettingStartedBlock').style.visibility = "hidden";

                document.getElementById('gettingStartedToggle').style.display = "block";
                document.getElementById('gettingStartedToggle').style.visibility = "visible";

                $toggle = false;

            }else{ //gettingStartedBlock is hidden

                document.getElementById('gettingStartedBlock').style.display = "block";
                document.getElementById('gettingStartedBlock').style.visibility = "visible";

                document.getElementById('gettingStartedToggle').style.display = "none";
                document.getElementById('gettingStartedToggle').style.visibility = "hidden";

                $toggle = true;
                document.getElementById('gettingstartedcheckbox').checked = false;

            }
        }
    </script>

    <x-jet-section-border />

</x-app-layout>
