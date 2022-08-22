<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table {
            margin: auto;
            margin-bottom: 1rem;
            width: 96%;
        }

        tr.sectionHeader {
            background-color: #cbd5e0;
            font-weight: bold;
            padding: 0 4px;
        }
        tr.sectionHeader th{
            font-size: 0.75rem;
            padding-left: .5rem;
            text-align: left;
        }
        tr.sectionDescr td{
            font-size: 1rem;
            font-style: italic;
            text-align: justify;
            padding-left: .5rem;
            padding-right: .5rem;
        }
        tr.sectionSignatures td{
            padding-top: 1rem;
        }
        .page_break{page-break-before: always;}
    </style>
    <title></title>
</head>
<body style="border: 1px solid white; padding: 1rem; ">

{{-- PAGE HEADER --}}
<table>
    <tr>
        <td style="width: 10%;">
            <img src="https://thedirectorsroom.com/assets/images/njmea_logo_state.jpg" alt="NJMEA Logo"/>
        </td>
        <td style="width: 72%;">
            <div style="font-weight: bold; text-align: center">{{ $registrant->student->person->user->schools->first()->name }}</div>
            <div style="text-align: center">NJ ALL-STATE CHORUS</div>
            <div style="text-align: center; font-size: 1rem;">
                Student Application - Page 1/2
            </div>
        </td>
        <td style="width: 10%; ">
            <div style="border: 1px solid transparent; color: white; text-align: center; padding: 1rem;">
                ADMIN<br/>USE<br/>ONLY
            </div>
        </td>
    </tr>
</table>

{{-- STUDENT DETAIL DECLARATION --}}
<style>
    table#detailDeclaration {border-collapse: collapse; margin: auto; margin-bottom: 1rem;}
    table#detailDeclaration td{border: 1px solid black; text-align: center; font-weight: bold;}
</style>
<table id="detailDeclaration">
    <tr>
        <td style="width: 40%;">
            {{ $registrant->student->person->fullName }}
        </td>
        <td style="width: 15%; color: red;">
            {{ strtoupper($registrant->instrumentationsCSV) }}
        </td>
        <td style="width: 15%;">
            Grade: {{ $registrant->student->gradeClassof }}
        </td>
        <td style="width: 30%;">
            {{ strlen($registrant->student->person->user->schools->first()->shortName) < 20
                ? $registrant->student->person->user->schools->first()->shortName
                : substr($registrant->student->person->user->schools->first()->shortName, 0, 20).'...' }}
        </td>
    </tr>
</table>

{{-- STUDENT ENDORSEMENT && AUDITION FEE--}}
<style>
    ul{margin-left: -1.5rem;}
    li{font-size: 0.84rem;}
</style>
<table>
    <tr class="sectionHeader">
        <th style="width: 50%;"> STUDENT ENDORSEMENT - SIGNATURE REQUIRED</th>
        <th style="text-align: right; ">
            THE AUDITION FEE IS: ${{ number_format($eventversion->eventversionconfigs->registrationfee,2) }}
        </th>
    </tr>
    <tr class="sectionDescr">
        <td colspan="2" style="font-size: .75rem;">
            <b>In return for the privilege of participating in an NJMEA sponsored NJ All-State Ensemble, I agree to
                the following:</b>
            <ul>
                <li>
                    I, <b>{{ $registrant->student->person->fullName }}</b>, agree to accept the decision of the
                    judges as binding. If selected, I will accept membership in the {{ $eventversion->name }} for which I have
                    auditioned. I also agree to pay the $25.00 participation fee. I understand that membership in this
                    organization may be terminated by the endorsers of my application if I fail to comply with the rules
                    set forth or if I fail to learn my music.
                </li>
                <li>
                    I understand that NJ All-State Mixed Chorus members are expected to attend all rehearsals
                    from June through November. NJ All-State Treble Chorus rehearsals continue until February. One
                    absence will result in testing at the following rehearsal. An absence is defined as missing any
                    scheduled rehearsal or any part thereof. I further understand that all activities must be attended
                    in their entirety. I understand that it is not possible for me to be a member of the NJ All-State
                    Chorus and participate in fall activities including Conference/NJSIAA tournament games that may take
                    place before/during the completion of my NJ All-State obligations. Failure to fulfill my NJ All-State
                    obligations will result in disqualification from any NJMEA sponsored event for the period of one year,
                    up to and including the applicable event. I understand that the manager, with the approval of the NJ
                    All-State Choral Procedures Committee, will resolve all serious conflicts and/or questionable
                    circumstances not specifically covered by the above.
                </li>
                <li>
                    I will respect the property of others, will act professionally, and will treat all members of the
                    ensemble with respect.
                </li>
                <li>
                    I will learn all the music to the best of my ability. <b>Chorus members agree to memorize all music.</b>
                </li>
                <li>
                    I will cooperate fully with managers, counselors, and all other administrative officials of the
                    NJ All-State Chorus and the New Jersey Music Educators Associations (NJMEA).
                </li>
                <li>
                    I will assume all responsibility for my music, folder, performance apparel, luggage and other
                    belongings at the sites of all rehearsals and concerts.
                </li>
                <li>
                    I will neither use nor have in my possession, at any time, alcoholic beverages, illegal drugs or
                    weapons of any kind.
                </li>
                <li>
                    I acknowledge that a Mixed Chorus member may not also participate in any of these other NJ All-State
                    ensembles: Orchestra, Jazz Ensemble or Vocal Jazz Ensemble. Treble Chorus members
                    may not be a member of the NJ All-State Band.
                </li>
                <li>
                    I understand that a total evaluation of my NJ All-State experience is used to determine any
                    recommendation for the Governor's Award, All-Eastern and/or National High School Ensembles. In
                    addition to my placement in the NJ All-State Chorus, such factors as behavior, promptness and
                    preparedness for rehearsals will also be considered. I understand the NJ All-State Administrative
                    personnel with the approval of the NJ All-State Choral Procedures Committee will make these
                    recommendations.
                </li>
                <li>
                    I will adhere to all dates concerning fees/forms or any other deadlines requested for my participation.
                </li>
                <li>
                    I understand that NJ All-State Chorus members are required to comply with all obligations set
                    forth above. Non-compliance with any provision contained herein shall constitute a breach of
                    this Agreement and shall serve as the basis of the participant's immediate termination and
                    exclusion from all performances.
                </li>
                <li>
                    I further understand that as a NJ All-State Chorus member, I must remain an active member in
                    good standing with the school ensemble that corresponds to my NJ All-State ensemble throughout
                    my entire All-State experience.
                </li>
            </ul>
        </td>
    </tr>
    <tr class="sectionSignatures">
        <td >
            STUDENT SIGNATURE: ________________________________
        </td>
        <td style="width: 20%;" >
            DATE: _______________
        </td>
    </tr>
    <tr class="sectionSignaturesSubscript">
        <td colspan="2" style="font-size: .8rem; padding-left: 12rem;">
            {{ $registrant->student->person->fullName }}
        </td>
    </tr>

    </tr>
</table>

{{-- PAGE BREAK ---------------------------------------------------------- --}}
<div class="page_break"></div>

{{-- PAGE HEADER --}}
<table>
    <tr>
        <td style="width: 10%;">
            <img src="https://thedirectorsroom.com/assets/images/njmea_logo_state.jpg" alt="NJMEA Logo"/>
        </td>
        <td style="width: 72%;">
            <div style="font-weight: bold; text-align: center">{{ $registrant->student->person->user->schools->first()->name }}</div>
            <div style="text-align: center">NJ ALL-STATE CHORUS</div>
            <div style="text-align: center; font-size: 1rem;">
                Student Application - Page 2/2
            </div>
        </td>
        <td style="width: 10%;">

        </td>
    </tr>
</table>

{{-- STUDENT DETAIL DECLARATION --}}
<style>
    table#detailDeclaration {border-collapse: collapse; margin: auto; margin-bottom: 1rem;}
    table#detailDeclaration td{border: 1px solid black; text-align: center; font-weight: bold;}
</style>
<table id="detailDeclaration">
    <tr>
        <td style="width: 40%;">
            {{ $registrant->student->person->fullName }}
        </td>
        <td style="width: 15%; color: red;">
            {{ strtoupper($registrant->instrumentationsCSV) }}
        </td>
        <td style="width: 15%;">
            Grade: {{ $registrant->student->gradeClassof }}
        </td>
        <td style="width: 30%;">
            {{ strlen($registrant->student->person->user->schools->first()->shortName) < 20
                ? $registrant->student->person->user->schools->first()->shortName
                : substr($registrant->student->person->user->schools->first()->shortName, 0, 20).'...' }}
        </td>
    </tr>
</table>

{{-- GUARDIAN ENDORSEMENT && AUDITION FEE--}}
<table style="margin-bottom: -0.5rem;">
    <tr class="sectionHeader">
        <th style="width: 50%;">PARENT/LEGAL GUARDIAN ENDORSEMENT - SIGNATURES REQUIRED</th>
        <th>THE AUDITION FEE IS: ${{ number_format($eventversion->eventversionconfigs->registrationfee,2) }}</th>
    </tr>
    <tr class="sectionDescr" style="font-size: 0.66rem;">
        <td colspan="2">
            As the parent or legal guardian of <b>{{ $registrant->student->person->fullName }}</b>, I declare that I have
            read the endorsement, which {{ $registrant->student->person->first }} has signed, and I give permission
            for {{ $registrant->student->person->pronoun->object }} to audition to become a member of the
            {{ $eventversion->name }}. I promise to assist {{ $registrant->student->person->first }} in
            fulfilling All-State obligations and in meeting any expenses necessary for rehearsals and concerts. I
            understand it is the policy of NJMEA that if an All-State student is incapacitated in any way that
            requires additional assistance, it will be the responsibility of the All-State student's parent/guardian/school
            to provide the necessary help at all rehearsals, meals, concerts, etc. The provided chaperone will be
            housed with the student and will be charged the regular student housing fee.
        </td>
    </tr>
    <tr class="sectionSignatures" style="font-size: 0.8rem;">
        <td >
            PARENT/LEGAL GUARDIAN SIGNATURE: __________________________
        </td>
        <td style="width: 20%;" >
            DATE: _____________________
        </td>
    </tr>
    <tr class="sectionSignaturesSubscript">
        <td colspan="2" style="font-size: .8rem;">
            PARENT/LEGAL GUARDIAN CELL: {{ $registrant->student->guardians->count() ? $registrant->student->guardians->first()->person->phoneMobile() : 'No number found' }}
        </td>
    </tr>
</table>

{{-- COVID ADVISORY --}}
<style>
    #covidadvisory{font-size: 0.6rem;}
</style>
<x-covid.njmeaadvisory orgname="NJMEA and the NJ All-State Chorus organization" />

{{-- PRINCIPAL/TEACHER ENDORSEMENT --}}
<table>
    <tr class="sectionHeader">
        <th colspan="2">PRINCIPAL/TEACHER ENDORSEMENT - SIGNATURES REQUIRED</th>
    </tr>
    <tr class="sectionDescr" style="font-size: 0.66rem;">
        <td colspan="2">
            We recommend <b>{{ $registrant->student->person->fullName }}</b> for participation in the {{ $eventversion->name }}.
            <b>{{ $registrant->student->person->first }}</b> is a qualified candidate in good
            standing in {{ $registrant->student->person->pronoun->possessive }} Choral Department and is presently
            enrolled in grade {{ $registrant->student->gradeClassof }} at {{ $registrant->student->person->user->schools->first()->name }}.
            We understand that <b>{{ $me->person->fullname }}</b>, who is sponsoring <b>{{ $registrant->student->person->fullName }}</b>,
            is a current (paid) member of the National Association for Music Educators (NAfME), and is required to
            participate as a JUDGE FOR ONLINE AUDITIONS, as described in the Directors's Packet, from April 28-30, 2022.
            <br />
            We will review this application to ensure that all parts are complete and accurate. This application
            will be mailed to the Registration Manager postmarked by the application deadline of <b>April 1st, 2022.</b>
            LATE APPLICATIONS WILL NOT BE ACCEPTED. If <b>{{ $registrant->student->person->fullName }}</b> is accepted,
            we will ensure that <b>{{ $registrant->student->person->first }}</b> is prepared and adheres to
            the rules and regulations set forth by the NJMEA.

        </td>
    </tr>
    <tr class="sectionSignatures" style="font-size: 0.66rem;">
        <td >
            HS PRINCIPAL SIGNATURE: ____________________________________________________
        </td>
        <td style="width: 20%;" >
            DATE: _________________
        </td>
    </tr>
    <tr class="sectionSignatures" style="font-size: 0.66rem;">
        <td >
            HS MUSIC TEACHER SIGNATURE: ______________________________________________
        </td>
        <td style="width: 20%;" >
            DATE: _________________
        </td>
    </tr>
    <tr class="sectionSignaturesSubscript">
        <td colspan="2" style="font-size: .8rem; padding-left: 17rem;">
             {{ $me->fullName }}
        </td>
    </tr>
</table>


</body>
</html>
