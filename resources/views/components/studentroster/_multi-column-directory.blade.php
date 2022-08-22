@props([
    'countstudents',
    'temp',
    'search',
    'filter',
])
<div class="mx-4"><!-- flex bg-green-200 -->
    <div class="bg-white "><!-- flex flex-col order-first flex flex-col flex-shrink-0 border-r border-gray-200 -->

        <div class="px-2 space-y-2"><!-- mx-4 px-4 pt-2 pb-2 bg-yellow-200  -->

            <!-- text-lg font-medium text-gray-900 -ml-6  -->
            <p class=" text-sm text-gray-600 pt-2">
                Search directory of {{ $countstudents }} student{{ ($countstudents > 1) ? 's' : '' }}
            </p>

            <form class="mt-6 flex" action="#">
                <div class="flex-1 min-w-0 ">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                            <!-- Heroicon name: magnifying glass solid/search -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input wire:model="search" type="search" name="search" id="search"
                               class="focus:ring-pink-500 focus:border-pink-500 block w-3/12 pl-10 sm:text-sm border-gray-300 rounded-md"
                               placeholder="Search Student Names">
                    </div>

                </div>
                <!-- {{-- <button type="submit"
                        class="inline-flex  px-3.5 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                    <!-- Heroicon name: solid/filter -->
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button> --}} -->
            </form>
        </div>

        <!-- Tab segments -->
        <div>

            <div class="block">
                <div class="border-b border-gray-200">
                    <nav class="flex justify-around space-x-8 mx-4" aria-label="Tabs">
                        <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                        <a href="#"
                           wire:click="$set('filter','current')"
                           class="inline-flex items-center py-4 px-1  font-medium text-sm {{($filter === 'current') ? 'border-indigo-500 text-indigo-600 border-b-2' : 'border-transparent text-gray-500 group hover:text-gray-700 hover:border-gray-300' }}">
                            <!-- Heroicon name: solid/user -->
                            <svg class="{{($filter === 'current') ? 'text-indigo-400 group-hover:text-indigo-500' : 'text-gray-400 group-hover:text-gray-500'}} -ml-0.5 mr-2 h-5 w-5"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span>Current</span>
                        </a>

                        <a href="#"
                           wire:click="$set('filter','alum')"
                           class="inline-flex items-center py-4 px-1  font-medium text-sm {{($filter === 'alum') ? 'border-indigo-500 text-indigo-600 border-b-2' : 'border-transparent text-gray-500 group hover:text-gray-700 hover:border-gray-300' }}">
                            <!-- Heroicon name: solid/office-building -->
                            <svg class="{{($filter === 'alum') ? 'text-indigo-400 group-hover:text-indigo-500' : 'text-gray-400 group-hover:text-gray-500'}} -ml-0.5 mr-2 h-5 w-5"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <span>Alum</span>
                        </a>

                        <a href="#"
                           wire:click="$set('filter','all')"
                           class="inline-flex items-center py-4 px-1  font-medium text-sm {{($filter === 'all') ? 'border-indigo-500 text-indigo-600 border-b-2' : 'border-transparent text-gray-500 group hover:text-gray-700 hover:border-gray-300' }}"
                           aria-current="page">
                            <!-- Heroicon name: solid/users -->
                            <svg class="{{($filter === 'all') ? 'text-indigo-400 group-hover:text-indigo-500' : 'text-gray-400 group-hover:text-gray-500'}} -ml-0.5 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            <span>All</span>
                        </a>

                    </nav>
                </div>
            </div>
        </div>

    </div>
</div>
