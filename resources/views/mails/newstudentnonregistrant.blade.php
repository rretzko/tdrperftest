Hi, Rick -

'Registrant {{ $event->user->person->fullname }}( {{ $event->user->id }}) grade {{ $event->user->student->grade }}
for: {{ $event->eventversion->name }} {{ $event->eventversion->id }}')
not created as: {{ implode(', ',$event->reasons) }}.


