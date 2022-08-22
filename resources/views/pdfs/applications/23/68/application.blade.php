<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table {
            margin: auto;
            margin-bottom: 1rem;
            width: 96%;
            font-size: .8rem;
        }

        tr.sectionHeader {
            background-color: #cbd5e0;
            font-weight: bold;
            padding: 0 4px;
        }
        tr.sectionHeader th{
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
    </style>
    <title></title>
</head>
<body style="border: 1px solid white; padding: 1rem; ">

{{-- PAGE HEADER --}}
<table>
    <tr>
        <td style="text-align: center; font-size: 1.5rem; font-weight: bold;">
            SOUTH JERSEY JR. & SR. HIGH CHORUS APPLICATION
        </td>
    </tr>
    <tr>
        <td style="text-align: center; font-size: 1.5rem;">
            {{ $eventversion->name }}
        </td>
    </tr>
    <tr>
        <td style="text-align: center; font-size: .8rem;">All signatures must be written clearly in ink and every category must
            be filled or the student will not be permitted to audition.
        </td>
    </tr>
</table>

{{-- STUDENT DETAIL DECLARATION --}}
<style>
    table.detailDeclaration {border-collapse: collapse; margin: auto; margin-bottom: 1rem;}
    table.detailDeclaration td.label{text-align:left; width: 20%; border: 0;}
    table.detailDeclaration td.data{text-align: left; font-weight: bold; border: 0;}
</style>
<table class="detailDeclaration">
    <tr>
        <td class="label">
            Student Name:
        </td>
        <td class="data">
            {{ $registrant->student->person->fullName }}
        </td>
    </tr>
    <tr>
        <td class="label">
            Address:
        </td>
        <td class="data">
            {{ ($registrant->student->person->user->address) ? $registrant->student->person->user->address->addressCSv : ''}}
        </td>
    </tr>
    <tr>
        <td class="label">
            Height:
        </td>
        <td class="data">
            {{ $registrant->student->heightFootInch }}
        </td>
    </tr>
    <tr>
        <td class="label" style="padding-top: .5rem;">
            Home Phone:
        </td>
        <td class="data" style="padding-top: .5rem;">
            {{ $registrant->student->phoneHome->id ? $registrant->student->phoneHome->phone : '' }}
        </td>
    </tr>
    <tr>
        <td class="label">
            Cell Phone:
        </td>
        <td class="data">
            {{ $registrant->student->phoneMobile->id ? $registrant->student->phoneMobile->phone : '' }}
        </td>
    </tr>
    <tr>
        <td class="label" style="padding-top: .5rem;">
            Email Personal:
        </td>
        <td class="data" style="padding-top: .5rem;">
            {{ $registrant->student->emailPersonal->id ? $registrant->student->emailPersonal->email : '' }}
        </td>
    </tr>
    <tr>
        <td class="label" >
            Email School:
        </td>
        <td class="data" style="padding-top: .5rem;">
            {{ $registrant->student->emailSchool->id ? $registrant->student->emailSchool->email : '' }}
        </td>
    </tr>
</table>


{{-- EMERGENCY CONTACT --}}
<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th colspan="2">Emergency Contact Information</th>
    </tr>
    <tr>
        <td class="label">
            Parent Name:
        </td>
        <td class="data">
            {{ $registrant->student->guardians->count() ? $registrant->student->guardians->first()->person->fullName : '' }}
        </td>
    </tr>
    <tr>
        <td class="label">
            Parent Phone:
        </td>
        <td class="data">
            {{ $registrant->student->guardians->count() ? $registrant->student->guardians->first()->phoneCsv : '' }}
        </td>
    </tr>
    <tr>
        <td class="label">
            Parent Email:
        </td>
        <td class="data">
            {{ $registrant->student->guardians->count() ? $registrant->student->guardians->first()->emailCsv : '' }}
        </td>
    </tr>
</table>

{{-- CHORAL DIRECTOR INFORMATION --}}
<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th colspan="2">Choral Director Information</th>
    </tr>
    <tr>
        <td class="label">
            Choral Director:
        </td>
        <td class="data">
            {{ auth()->user()->person->fullName }}
        </td>
    </tr>
    <tr>
        <td class="label">
            Phones:
        </td>
        <td class="data">
            {{ auth()->user()->person->subscriberPhoneCsv }}
        </td>
    </tr>
</table>

{{-- AUDITION INFORMATION --}}
<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th colspan="2">Audition Informtion</th>
    </tr>
    <tr>
        <td class="label">
            Grade:
        </td>
        <td class="data">
            {{ $registrant->student->gradeClassof }}
        </td>
    </tr>
    <tr>
        <td class="label">
            Preferred Pronoun:
        </td>
        <td class="data">
            {{ $registrant->student->person->pronoun->descr }}
        </td>
    </tr>
    <tr>
        <td class="label">
            Voice Part:
        </td>
        <td class="data">
            {{ $registrant->instrumentations->first()->formattedDescr() }}
        </td>
    </tr>
</table>

{{-- ENDORSEMENTS --}}
<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th>Endorsement - Signature Required</th>
    </tr>
    <tr>
        <td>
            We, the undersigned, recommend <b>{{ $registrant->student->person->fullName }}</b>
            to audition for the {{ $eventversion->name }}.  <b>{{ $registrant->student->person->first }}</b>
            is aware of the fact that {{ $registrant->student->person->pronoun->personal }}
            must remain an active member in good standing of the school performing group
            throughout {{ $registrant->student->person->pronoun->possessive }} South
            Jersey experience.  {{ ucwords($registrant->student->person->pronoun->personal) }}
            is a qualified student, and is now enrolled in Grade {{ $registrant->student->grade }}
            at <b>{{ $registrant->student->person->user->schools()->first()->name }}</b>.
            In the event that <b>{{ $registrant->student->person->fullName }}</b> is
            accepted for membership in this chorus, we will use our influence to see that
            {{ $registrant->student->person->pronoun->personal }} is properly prepared,
            and all whose signatures appear on this application will adhere to the Rules
            and Regulations of the South Jersey Chorus.  We agree to the stated
            attendance policy and all relevant policies stated in the SJCDA Choral
            auditions packet.  Students will be removed from the chorus at any time if a
            jury of choral directors selected by the Festival Coordinator determines the
            student cannot capably perform their music, or if the student failes to meet
            the requirements outlined in this packet.
        </td>
    </tr>

    <tr>
        <td style="font-weight: bold;">{{-- COVID-19 ADVISORY --}}
            COVID-19 ADVISORY
        </td>
    </tr>
    <tr>
        <td>
            <p class="mb-4">
                By registering for/attending this event, I acknowledge that I fully
                understand the nature and extent of the risks presented by COVID-19 due
                to my in-person attendance at this event, including the risk that
                COVID-19 may lead to severe illness or death. I also understand and
                acknowledge that there are risks of exposure to COVID-19, whether
                resulting from travel through high-risk areas, the failure of other
                individuals to follow proper COVID-19 protocols, such as maintaining
                proper social distancing and proper hygiene measures, and other such
                risks. While I understand that SJCDA has taken reasonable steps to address
                the risks presented by COVID-19, I recognize that the COVID-19 protocols
                being utilized at the event may be insufficient to prevent my contracting
                COVID-19 and suffering any related injuries, and that I expressly
                nevertheless assume all of these risks.
            </p>
            <p>
                With full knowledge of the risks involved, therefore, I hereby release,
                waive, and discharge SJCDA, its officers, directors, employees,
                contractors, and agents, from any and all liability, loss, damage, claims,
                demands, actions, and causes of action whatsoever, including reasonable
                attorneys' fees, directly or indirectly arising out of or related to any
                loss, damage, injury, or death, that may be sustained by me while
                participating in this event or while in, on, or around the event premises
                that may lead to exposure or harm due to COVID-19.
            </p>
        </td>
    </tr>
</table>

{{-- SIGNATURES HEADER --}}
<table>
    <tr>
        <td style="text-align: center;">
            ALL SIGNATURES MUST BE ORIGINAL
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            NO SIGNATURE STAMPS OR PHOTOCOPIED SIGNATURES ARE ALLOWED
        </td>
    </tr>
</table>

{{-- SIGNATURES --}}
<table>
    <tr><td style="padding-top: 2rem;"></td></tr>
    <tr>
        <td style="border-top: 1px solid black; text-align: center;">
            Principal Signature
        </td>
        <td style="width: 2%;"></td>
        <td style="border-top: 1px solid black; text-align: center;">
            {{ auth()->user()->person->fullName }} Signature
        </td>
    </tr>
    <tr><td style="padding-top: 2rem;"></td></tr>
    <tr>
        <td style="border-top: 1px solid black; text-align: center;">
            Parent/Guardian Signature
        </td>
        <td style="width: 2%;"></td>
        <td style="border-top: 1px solid black; text-align: center;">
            {{ $registrant->student->person->fullName }} Signature
        </td>
    </tr>
</table>

</body>
</html>
