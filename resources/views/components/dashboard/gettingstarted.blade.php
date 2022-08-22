@props([
 'gettingstarted',
])
<div class="bg-white border border-red-600 rounded px-2 py-1">
    <header class="text-lg italic font-bold text-center">Getting Started!</header>
    Welcome and Thank you for registering with TheDirectorsRoom.com!
    <p class="my-4">
        This message will remain here until you click the button at the bottom of the page.
        You will also find an amplified version under the 'Site Orientation PDFs' box on your right (or below
        if you're viewing this on a mobile device).  It'll remain there in case you need it for future reference!
    </p>

    <p>
        Here's your checklist:
        <ol class="ml-8 list-decimal">
        <li>
            <b>Check your Profile</b>
            <span class="hint text-xs">(See the "<b>{{ auth()->user()->username }}</b>" at the
                top-right-hand corner of the page?  Click that and then the "Profile" link.)</span>
        </li>

        <li>
            <b>Add your school(s)</b><span class="hint text-xs">("Schools" link at the top of the page)</span>
        </li>

        <li>
            <b>Add Students</b><span class="hint text-xs">(It'll be easier on your time and fingers
            if you'll encourage your students to self-register on StudentFolder.info.  Once they add their information,
                you'll immediately see it here!)</span>
        </li>

        <li>
            <b>Add Ensembles</b> <span class="hint text-xs">(Really?  Yes!  Our goal is to be your one-stop-shop for
            managing <i>all</i> of the thousands of data points which make up your program.  Ensembles are a big part
            of that program.)</span>
        </li>

        <li>
            <b>Add to your Library</b> <span class="hint text-xs">(What's an ensemble without music to perform?
                Enter library information and we'll keep track of it here...and much more...)</span>
        </li>

        <li>
            <b>Check your organization memberships</b> <span class="hint text-xs">("Organizations" link at the top of the
            page.  This is especially important if you've come here to register your students for an organization's auditions,
                for example, the NJ All-State Chorus!)</span>
        </li>


        <li>
            <b>Register your students for open Auditions</b> <span class="hint text-xs">(Use your student information
                from #3 above to  quickly register your students for upcoming auditions.  And, again, your students
                can again save you time and trouble by registering themselves at StudentFolder.info!)</span>
        </li>
    </ol>
    </p>

    <p class="mt-4">
        Looking for a deeper dive?<br />
        Click the <a href="/assets/docs/TheDirectorsRoomOrientation.pdf" class="text-blue-700" target="_BLANK">TheDirectorsRoom.com</a>
        under the "Site Orientation PDFs" card for much more detailed information!
    </p>

    <div class="bg-gray-300 mt-4 px-2 py-1 text-center rounded w-11/12 mx-auto">
        @if((isset($gettingstarted)) && ($gettingstarted)) {{-- User has previously hidden getting started block --}}
            <span class="text-black text-center w-full cursor-pointer" onclick="toggleGettingStarted()">OK, I've got it.  You can close now.</span>
        @else
            <a href="{{ route('dashboard.gettingstarted') }}" class="text-black text-center w-full">OK, I've got it.  You can close now.</a>
        @endif
    </div>
</div>
