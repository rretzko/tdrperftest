Hi, {{ $registrant->student->person->first }} -

{{ auth()->user()->person->fullName }} has requested that you re-submit your {{ strtoupper($filecontenttype->descr) }} audition
file for  {{ $eventversion->name }}.

You may resubmit this file by logging into <a href="https://studentfolder.info">StudentFolder.info</a>
and clicking the 'Event' link.

Thanks!

Rick Retzko
Founder: TheAuditionSuite.com
