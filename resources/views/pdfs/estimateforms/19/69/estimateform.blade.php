<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table {
            border-collapse: collapse;
            margin: auto;
            margin-bottom: 1rem;
            width: 96%;
        }
        .page_break{page-break-before: always;}
    </style>
    <title></title>
</head>
<body style="border: 1px solid white; padding: 1rem; ">

<table style="border-bottom: 1px solid darkgrey;">
    <tr>
        <th>{{ $eventversion->name }}</th>
    </tr>
</table>

{{-- SEND TO INSTRUCTIONS --}}
{{-- SEND TO --}}
<table style="text-align: center; border-bottom: 1px solid darkgrey;">
    <tr>
        <td>Sent to: Emily Kneuer, Treasurer</td>
    </tr>
    <tr>
        <td>
            <b>Raritan High School</b>
        </td>
    </tr>
    <tr>
        <td>419 Middle Road</td>
    </tr>
    <tr>
        <td>Hazlet, NJ 07730</td>
    </tr>
</table>

<table style="border-bottom: 1px solid darkgrey;">
    <tr>
        <th>INVOICE</th>
    </tr>
    <tr>
        <th>{{ $eventversion->name }}</th>
    </tr>
    <tr>
        <th>STUDENT AUDITION FEE INVOICE</th>
    </tr>
    <tr>
        <th style="padding: 1rem 0;">${{ number_format($eventversion->eventversionconfigs->registrationfee, 2) }} Per Student</th>
    </tr>
    <tr>
       <th style="padding-bottom: 1rem;">DUE: November 3<sup>rd</sup>, 2021</th>
    </tr>
    <tr>
        <th>Please send one check for all students auditioning at your school.<br />
        Please make out all checks to "All-Shore Chorus Inc.</th>
    </tr>
</table>

<table style="margin: auto;">
    <tr>
        <td style="width: 20rem;">School</td>
        <th style="text-align: left;">{{ $school->name }}</th>
    </tr>
    <tr>
        <td>Date</td>
        <th style="text-align: left;" >{{ \Carbon\Carbon::now()->format('d-M-Y') }}</th>
    </tr>
    <tr>
        <td>Number of Students Auditioning</td>
        <th style="text-align: left;" >{{ $registrants->count() }}</th>
    </tr>
    <tr>
        <td>Choral Director</td>
        <th style="text-align: left;" >{{ auth()->user()->person->fullName }}</th>
    </tr>
    <tr>
        <td>
            Total amount enclosed: ({{ $registrants->count() }} of students x ${{ number_format($eventversion->eventversionconfigs->registrationfee, 2) }})
        </td>
        <th style="text-align: left;" >
            ${{ number_format($registrants->count() * $eventversion->eventversionconfigs->registrationfee, 2) }}
        </th>
    </tr>
</table>

</body>
</html>
