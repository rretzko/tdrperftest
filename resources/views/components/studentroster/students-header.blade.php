@props([
'countstudents',
'temp',
'search',
'showimportexport',
'filter',
])
<div class="md:w-full">

    <div class="bg-white pb-1"><!-- flex flex-col order-first flex flex-col flex-shrink-0 border-r border-gray-200 -->

        <div class="px-2 space-y-2">

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
                        <input wire:model="searchstring" type="search" name="search" id="search"
                               class="focus:ring-blue-500 focus:border-blue-500 block w-3/12 pl-10 sm:text-sm border-gray-300 rounded-md w-10/12"
                               placeholder="Search Student Names">
                    </div>

                </div>
            </form>
        </div>

        <!-- Tab segments -->
        <!-- SMALL VIEWPORT SELECT DROP-DOWN -->
        <div class="block sm:hidden w-full my-2 pl-2">
            <select
                wire:model="filter"
                class="focus:ring-blue-500 focus:border-blue-500 w-8/12  sm:text-sm border-gray-300 rounded-md"
            >
                <option value="current">
                    Current
                    <!-- Heroicon name: solid/user -->
                    <svg class=" {{($filter === 'current') ? 'text-indigo-400 group-hover:text-indigo-500' : 'text-gray-400 group-hover:text-gray-500'}} -ml-0.5 mr-2 h-5 w-5"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                              clip-rule="evenodd"/>
                    </svg>
                </option>
                <option value="alum">
                    <!-- Heroicon name: solid/academic-cap -->
                    <svg class="{{($filter === 'alum') ? 'text-indigo-400 group-hover:text-indigo-500' : 'text-gray-400 group-hover:text-gray-500'}} -ml-0.5 mr-2 h-5 w-5"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20"
                         fill="currentColor"
                    >
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                    </svg>
                    Alum
                </option>
                <option value="all">
                    <!-- Heroicon name: solid/users -->
                    <svg class="{{($filter === 'all') ? 'text-indigo-400 group-hover:text-indigo-500' : 'text-gray-400 group-hover:text-gray-500'}} -ml-0.5 mr-2 h-5 w-5"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                              clip-rule="evenodd"/>
                    </svg>
                    All
                </option>
                <option value="new">
                    <!-- Heroicon name: solid/user-add -->
                    <svg class="text-gray-400 group-hover:text-gray-500 h-5 w-5"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20"
                         fill="currentColor"
                         aria-hidden="true"
                    >
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                    </svg>
                    New
                </option>
                <option value="export">
                    <!-- Heroicon name: cog -->
                    <svg class="text-gray-400 group-hover:text-gray-400 h-5 w-5"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 20 20"
                         stroke="currentColor"
                         aria-hidden="true"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Csv
                </option>
        <!-- {{--
                <option value="export">
                    <!-- Heroicon name: cog -->
                    <svg class="text-gray-400 group-hover:text-gray-400 h-5 w-5"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 20 20"
                         stroke="currentColor"
                         aria-hidden="true"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Xls
                </option>
                <option value="export">
                    <!-- Heroicon name: cog -->
                    <svg class="text-gray-400 group-hover:text-gray-400 h-5 w-5"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 20 20"
                         stroke="currentColor"
                         aria-hidden="true"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Pdf
                </option>
    --}} -->
            </select>
        </div>

        <!-- MEDIUM ICON LINKS -->
        <div class="hidden md:block">

            <!-- ICONS -->
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
                            <!-- Heroicon name: solid/academic-cap -->
                            <svg class="{{($filter === 'alum') ? 'text-indigo-400 group-hover:text-indigo-500' : 'text-gray-400 group-hover:text-gray-500'}} -ml-0.5 mr-2 h-5 w-5"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor"
                            >
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                            <span>Alum</span>
                        </a>

                        <a href="#"
                           wire:click="$set('filter','all')"
                           class="inline-flex items-center py-4 px-1 font-medium text-sm {{($filter === 'all') ? 'text-blue-400 border-blue-400 border-b-2' : 'border-transparent text-gray-500 group hover:text-gray-700 hover:border-gray-300' }}"
                           aria-current="page">
                            <!-- Heroicon name: solid/users -->
                            <svg class="{{($filter === 'all') ? 'text-blue-400 group-hover:text-indigo-500' : 'text-gray-600 group-hover:text-gray-500'}} -ml-0.5 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            <span>All</span>
                        </a>

                        <a href="#"
                           wire:click="createStudent"
                           class="inline-flex items-center py-4 px-1  font-medium text-sm {{($filter === 'new') ? 'border-indigo-500 text-indigo-600 border-b-2' : 'border-transparent text-gray-500 group hover:text-gray-700 hover:border-gray-300' }}"
                           aria-current="page">
                            <!-- Heroicon name: solid/user-add -->
                            <svg class="text-gray-400 group-hover:text-gray-500 h-5 w-5"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor"
                                 aria-hidden="true"
                            >
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                            </svg>
                            <span class="pl-2">New</span>
                        </a>

                        <a href="#"
                           wire:click="$set('showimportexport',{{ ! $showimportexport }})"
                           class="inline-flex items-center py-4 px-1  font-medium text-sm {{($filter === 'tools') ? 'border-indigo-500 text-indigo-600 border-b-2' : 'border-transparent text-gray-500 group hover:text-gray-700 hover:border-gray-300' }}"
                           aria-current="page">
                            <!-- Heroicon name: cog -->
                            <svg class="text-gray-400 group-hover:text-gray-500 h-5 w-5"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 20 20"
                                 stroke="currentColor"
                                 aria-hidden="true"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="pl-2">Tools</span>
                        </a>

                    </nav>
                </div>
            </div>

            <!-- IMPORT/EXPORT -->
            @if($showimportexport)
                <div class="flex justify-evenly mt-2 bg-gray-200 py-2">
                    <!-- <div>
                        <input type="radio" name="importexport" id="import" value="import" />
                        <label>Import</label>
                    </div>
                    <div>
                        <input type="radio" name="importexport" id="export" value="export" />
                        <label>Export</label>
                    </div> -->
                    <button
                        class="font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 bg-yellow-100 disabled:opacity-50 disabled:cursor-not-allowed"
                        type="button"
                        wire:click="export('csv')"
                        wire:loading.attr="disabled"
                    >
                        IMPORT
                    </button>
                    <button
                        class="font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 bg-yellow-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        type="button"
                        wire:click="export('csv')"
                        wire:loading.attr="disabled"
                    >
                        CSV
                    </button>
        <!-- {{--
                    <button
                        class="font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 bg-yellow-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        type="button"
                        wire:click="export('xlsx')"
                        wire:loading.attr="disabled"
                    >
                        XLS
                    </button>
                    <button
                        class="font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 bg-yellow-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        type="button"
                        wire:click="export('pdf')"
                        wire:loading.attr="disabled"
                    >
                        PDF
                    </button>
        --}} -->
                </div>
            @endif

        </div>

    </div>
</div>
