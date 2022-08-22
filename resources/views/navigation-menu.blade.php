<nav class="display:block md:hidden  flex flex-row justify-center mx-4 mb-2 px-4 text-white py-1">

    <!-- DASHBOARD: mobile -->
    <a href="{{ route('dashboard') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
            {{ (strpos(Route::currentRouteName(), 'dashboard')) === 0 ? 'active' : ''  }} "
       title="Dashboard"
    >
        <!-- heroicon clipboard-check -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor" >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>
    </a>

    <!-- SCHOOLS:mobile -->
    <a href="{{ route('schools') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'schools')) === 0 ? 'active' : ''  }} "
       title="Schools"
    >
        <!-- heroicon library building -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
        </svg>
    </a>

    <!-- STUDENTS: mobile -->
    <a href="{{ route('students.index') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'students')) === 0 ? 'active' : ''  }} "
       title="Students"
    >
        <!-- heroicon academic-cap -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z"/>
            <path fill="#fff"
                  d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
        </svg>
    </a>
    <a href="{{ route('ensembles.index') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
            {{ (
            (strpos(Route::currentRouteName(), 'ensembles') === 0) ||
            (strpos(Route::currentRouteName(), 'ensemble.create') === 0) ||
            (strpos(Route::currentRouteName(), 'ensemble.edit') === 0) ||
            (strpos(Route::currentRouteName(), 'ensemblemembers.index') === 0)  ||
            (strpos(Route::currentRouteName(), 'ensemble.assets.index') === 0)
             )
                ? 'active' : ''  }} "
       title="Ensembles"
    >

        <!-- heroicon microphone -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
        </svg>
    </a>
    <a href="{{ route('library.index') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'library')) === 0 ? 'active' : ''  }} "
       title="Library"
    >
        <!-- heroicon book-open -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
    </a>
    <a href="{{ route('organizations.index') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
            {{ (
                (strpos(Route::currentRouteName(), 'organizations.index') === 0) ||
                (strpos(Route::currentRouteName(), 'organization.membershipcard') === 0)
             )
                ? 'active' : ''  }}"
       title="Organizations"
    >
        <!-- heroicon briefcase -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
    </a>
    <a href="{{ route('eventversions.index') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
            {{ (
                (strpos(Route::currentRouteName(), 'events') === 0)   ||
                (strpos(Route::currentRouteName(), 'registrants.index') === 0) ||
                (strpos(Route::currentRouteName(), 'eventversions.index') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.show') === 0) ||
                (strpos(Route::currentRouteName(), 'pitchfiles') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.application.create') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.estimateform') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.estimateform.download') === 0)
             )
                ? 'active' : ''  }} "
       title="Auditions"
    >
        <!-- heroicon cake -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
        </svg>
    </a>
</nav>

<!-- Medium screen word menu -->
<nav class="hidden md:flex lg:hidden flex-row justify-center text-white mb-4">

    <!-- DASHBOARD: Medium -->
    <a href="{{ route('dashboard') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'dashboard')) === 0 ? 'active' : ''  }}">
        Dashboard
    </a>

    <!-- SCHOOLS: Medium -->
    <a href="{{ route('schools') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'schools')) === 0 ? 'active' : ''  }}">
        Schools
    </a>

    <!-- STUDENTS: Medium -->
    <a href="{{ route('students.index') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'students')) === 0 ? 'active' : ''  }}">
        Students
    </a>
    <a href="{{ route('ensembles.index') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
        {{ (
            (strpos(Route::currentRouteName(), 'ensembles') === 0) ||
            (strpos(Route::currentRouteName(), 'ensemble.create') === 0) ||
            (strpos(Route::currentRouteName(), 'ensemble.edit') === 0) ||
            (strpos(Route::currentRouteName(), 'ensemblemembers.index') === 0)  ||
            (strpos(Route::currentRouteName(), 'ensemble.assets.index') === 0)
             )
                ? 'active' : ''  }}">
        Ensembles
    </a>
    <a href="{{ route('library.index') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'library')) === 0 ? 'active' : ''  }}">
        Library
    </a>
    <a href="{{ route('organizations.index') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
        {{ (
                (strpos(Route::currentRouteName(), 'organizations.index') === 0) ||
                (strpos(Route::currentRouteName(), 'organization.membershipcard') === 0)
             )
                ? 'active' : ''  }}"
    >
        Organizations
    </a>
    <a href="{{ route('eventversions.index') }}"
       class="border border-gray-500 rounded px-2 py-1 ml-0.5
        {{ (
                (strpos(Route::currentRouteName(), 'events') === 0)   ||
                (strpos(Route::currentRouteName(), 'registrants.index') === 0) ||
                (strpos(Route::currentRouteName(), 'eventversions.index') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.show') === 0) ||
                (strpos(Route::currentRouteName(), 'pitchfiles') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.application.create') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.estimateform') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.estimateform.download') === 0)
             )
                ? 'active' : ''  }}"
    >
        Auditions
    </a>
</nav>

<!-- Large icon + screen word menu -->
<nav class="hidden lg:flex flex-row justify-center text-white mb-4">

    <!-- DASHBOARD: Large -->
    <a href="{{ route('dashboard') }}"
       class="flex flex-row border border-blue-300 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'dashboard')) === 0 ? 'active' : ''  }}">

        <!-- heroicon clipboard-check -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>
        <div class="ml-1">Dashboard</div>
    </a>

    <!-- SCHOOLS: Large -->
    <a href="{{ route('schools') }}"
       class="flex flex-row border border-blue-300 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'schools')) === 0 ? 'active' : ''  }}">
        <!-- heroicon library building-->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
        </svg>
        <div class="ml-1">Schools</div>
    </a>

    <!-- STUDENTS: Large -->
    <!-- {{-- <a href="{{ route('xstudents') }}"
       class="flex flex-row border border-blue-300 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'students')) === 0 ? 'active' : ''  }}">
        <!-- heroicon academic-cap -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z"/>
            <path fill="#fff"
                  d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
        </svg>
        <div class="ml-1">Students:old</div>
    </a> --}} -->

    <!-- STUDENTS: NEW -->
    <a href="{{ route('students.index') }}"
       class="flex flex-row border border-blue-300 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'students')) === 0 ? 'active' : ''  }}">
        <!-- heroicon academic-cap -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z"/>
            <path fill="#fff"
                  d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
        </svg>
        <div class="ml-1">Students</div>
    </a>

    <!-- ENSEMBLES -->
    <a href="{{ route('ensembles.index') }}"
       class="flex flex-row border border-blue-300 rounded px-2 py-1 ml-0.5
        {{ (
            (strpos(Route::currentRouteName(), 'ensembles') === 0) ||
            (strpos(Route::currentRouteName(), 'ensemble.create') === 0) ||
            (strpos(Route::currentRouteName(), 'ensemble.edit') === 0) ||
            (strpos(Route::currentRouteName(), 'ensemblemembers.index') === 0)  ||
            (strpos(Route::currentRouteName(), 'ensemble.assets.index') === 0)
             )
                ? 'active' : ''  }}">
        <!-- heroicon microphone -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
        </svg>
        <div class="ml-1">Ensembles</div>
    </a>
    <a href="{{ route('library.index') }}"
       class="flex flex-row border border-blue-300 rounded px-2 py-1 ml-0.5
        {{ (strpos(Route::currentRouteName(), 'library')) === 0 ? 'active' : ''  }}">
        <!-- heroicon book-open -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        <div class="ml-1">Library</div>
    </a>

    <!-- ORGANIZATIONS -->
    <a href="{{ route('organizations.index') }}"
       class="flex flex-row border border-blue-300 rounded px-2 py-1 ml-0.5
       {{ (
                (strpos(Route::currentRouteName(), 'organizations.index') === 0) ||
                (strpos(Route::currentRouteName(), 'organization.membershipcard') === 0)
             )
                ? 'active' : ''  }}"
    >
        <!-- heroicon briefcase -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        <div class="ml-1">Organizations</div>
    </a>
    <a href="{{ route('eventversions.index') }}"
       class="flex flex-row border border-blue-300 rounded px-2 py-1 ml-0.5
        {{ (
                (strpos(Route::currentRouteName(), 'events') === 0)   ||
                (strpos(Route::currentRouteName(), 'registrants.index') === 0) ||
                (strpos(Route::currentRouteName(), 'eventversions.index') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.show') === 0) ||
                (strpos(Route::currentRouteName(), 'pitchfiles') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.application.create') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.estimateform') === 0) ||
                (strpos(Route::currentRouteName(), 'registrant.estimateform.download') === 0)
             )
                ? 'active' : ''  }}"
    >

        <!-- heroicon cake -->
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20px" height="20px"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
        </svg>
        <div class="ml-1">Auditions</div>
    </a>
</nav>

