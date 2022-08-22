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

        table.endorsements{
            font-size: .7rem;
            margin: 0;
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
        .page_break{page-break-before: always;}
    </style>
    <title></title>
</head>
<body style="border: 1px solid white; padding: 1rem; ">

{{-- PAGE HEADER --}}
<table>
    <tr>
        <td style="width: 10%;">
             <img src="https://thedirectorsroom.com/assets/images/cjmealogo.png" alt="CJMEA Logo"/>
        </td>
        <td style="width: 72%;">
            <div style="font-weight: bold;">
                <div style="text-align: right;">{{ $eventversion->short_name }}</div>
                <div style=" text-align: right;">2021 On-Site Student Application</div>
            </div>
        </td>
    </tr>
</table>

{{-- ON-SITE APPLICATION ADVISORY --}}
<table style="font-size: .8rem; margin-top: -1rem;">
    <tr style="border: 1px solid red;">
        <td style="color: darkred; text-align: center;border: 1px solid red;">***** ON-SITE APPLICATION *****</td>
    </tr>
</table>

{{-- ADVISORY --}}
<table style="font-size: .8rem; margin-top: -1rem;">
    <tr>
        <th style="text-align: center;">
            ALL ENDORSEMENTS MUST BE SIGNED IN INK FOR THIS APPLICATION TO BE ACCEPTED.
        </th>
    </tr>
    <tr>
        <th style="text-align: center;">
            GIVE THE SIGNED ENDORSEMENT TO YOUR TEACHER.
        </th>
    </tr>
    <tr>
        <th style="text-align: center; font-size: .66rem;">
            Page 1 of 2
        </th>
    </tr>
</table>

{{-- STUDENT DETAIL DECLARATION --}}
<style>
    table.detailDeclaration {border-collapse: collapse; margin: auto; margin-bottom: 1rem;}
    table.detailDeclaration td{border: 1px solid black; text-align: center; font-weight: bold;}
</style>
<table class="detailDeclaration">
    <tr>
        <td style="width: 35%;">
            {{ $registrant->student->person->fullName }}
        </td>
        <td style="width: 15%; color: red;">
            {{ strtoupper($registrant->instrumentationsCSV) }}
        </td>
        <td style="width: 20%;">
            Grade: {{ $registrant->student->gradeClassof }}
        </td>
        <td style="width: 30%;">
            {{ strlen($schoolname) < 20
                ? $schoolname
                : substr($schoolname, 0, 20).'...' }}
        </td>
    </tr>
</table>

{{-- PHONES TABLE --}}
<table class="detailDeclaration">
    <thead>
        <tr style="background-color: rgba(0,0,0,.1);">
            <td style="text-align: center; font-weight: normal;">Home Phone</td>
            <td style="text-align: center; font-weight: normal;">Student Cell Phone</td>
            <td style="text-align: center; font-weight: normal;">Parent Phone</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center; font-weight: normal; border-bottom: 1px solid black;">
                @if($registrant->student->phoneHome->id)
                    {{ $registrant->student->phoneHome->phone }}
                @else
                    No Home Phone
                @endif
            </td>
            <td style="text-align: center; font-weight: normal;">
                @if($registrant->student->phoneMobile->id)
                    {{ $registrant->student->phoneMobile->phone }}
                @else
                    No Cell Phone
                @endif
            </td>

            <td style="text-align: center; font-weight: normal;">
                @if($registrant->student->guardians->count() &&
                        $registrant->student->guardians->first()->user_id &&
                        $registrant->student->guardians->first()->phoneMobile->id)
                    {{ $registrant->student->guardians->first()->phoneMobile->phone }}
                @else
                    No Parent Phone
                @endif
            </td>
        </tr>
    </tbody>
</table>

{{-- STUDENT ENDORSEMENT --}}
<table class="endorsements" >
    <tr>
        <th style="text-align: left;">
            <span style="text-decoration: underline;">STUDENT ENDORSEMENT</span>
        </th>
    </tr>
    <tr>
        <td style="text-align: justify;">
                I agree to accept the decision of the judges as binding and if selected I
                will accept membership in this organization. I understand that membership
                in this organization may be terminated by anyone that has endorsed this
                application if I fail to comply with the rules set forth, or if I fail to
                attend rehearsals for any reason not accepted, in advance, by the CJMEA
                Committee.  I understand that I must be a member of
                {{$registrant->student->currentSchool->shortName}}'s musical performing
                organization. I further understand that I must remain an active member of
                {{$registrant->student->currentSchool->shortName}}'s performing group, in
                good standing, throughout my CJMEA Region II Chorus experience.  I have read,
                understand and will adhere to the required attendance dates and policy.
        </td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td style="padding-top: 1rem;">
                        Student Signature ______________________________________
                    </td>
                    <td style="padding-top: 1rem;">
                        Date: _________________
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

{{-- PARENT ENDORSEMENT --}}
<table class="endorsements" >
    <tr>
        <th style="text-align: left;">
            <span style="text-decoration: underline;">PARENT ENDORSEMENT</span>
        </th>
    </tr>
    <tr>
        <td style="text-align: justify;">
            As a parent or legal guardian of {{$registrantfullname}}, I give permission for {{$registrantfirstname}} to
            be an applicant for this organization. I understand that neither {{$schoolname}} nor CJMEA assumes responsibility
            for illness or accident.  I further attest to the statement signed by {{$registrantfullname}} and will assist
            {{$registrantfirstname}} in fulfilling the obligation incurred.  I will encourage and assist {{$registrantfirstname}}
            in complying with the attendance policy as set forth in this document.  I also give permission to CJMEA to
            use {{$registrantfirstname}}'s photograph for publicity publication in print and online
        </td>
    </tr>
    <tr>
        <td style="text-align: justify;">
            I have read and acknowledged the rehearsal and concert schedule and I will make arrangements to pick up
            {{ $registrantfirstname }} on or within twenty-minutes after posted rehearsal dismissal time.
        </td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td style="padding-top: .5rem;">
                        Parent Signature ______________________________________
                    </td>
                    <td style="padding-top: .5rem;">
                        Date: _________________
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

{{-- DIRECTOR/PRINCIPAL'S ENDORSEMENT --}}
<table class="endorsements" >
    <tr>
        <th style="text-align: left;">
            <span style="text-decoration: underline;">DIRECTOR/PRINCIPAL'S ENDORSEMENT</span>
        </th>
    </tr>
    <tr>
        <td style="text-align: justify;">
            We, the undersigned, recommend {{$registrantfullname}} for participation in the CJMEA sponsored activity.
            {{$registrantfirstname}} is a qualified candidate for this activity and is presently enrolled in grade
            {{$registrant->student->grade}} at {{$schoolname}}.  We understand, in order to audition, that {{$registrantfirstname}}:
            <ol>
                <li>
                    is a member of {{$schoolname}}'s musical performing organization.  By this we mean that a student
                    auditioning for chorus must be a member of the {{$schoolname}} choral program, and a student auditioning
                    for band or orchestra must be a member of {{$schoolname}} instrumental program.<br />
            OR
                </li>
                <li>
                    does not have a corresponding school musical performing organization at the school or home school
                    where they attend but that we know this student and will attest to their ability and character.
                </li>
            </ol>
            <p style="text-align: justify;">
            A CJMEA Region II Chorus member must remain an active member, in good standing, of the school performing
            organization throughout the CJMEA Region I Chorus experience.  We understand that
            {{$registrant->student->currentTeachername}} sponsoring this student is a paid member of NAfME and will be
            present on the day of auditions and will serve and complete the assignment given to them by the audition
            chairperson.  We also understand that we will review this application to be sure that all parts are completed
            correctly.  In the event that {{$registrantfullname}} is accepted into the group, we will use our influence
            to see that {{$registrantfirstname}} is properly prepared and that {{$registrantfirstname}} adheres to the
            rules, regulations, and policies printed on this application and set forth by the performing groups.
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td style="padding-top: 1rem;">
                        Director Signature _______________________
                    </td>
                    <td style="padding-top: 1rem;">
                        Principal Signature ______________________
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

<div class="page_break"></div>

{{-- PAGE HEADER --}}
<table>
    <tr>
        <td style="width: 10%;">
            <img src="https://thedirectorsroom.com/assets/images/cjmealogo.png" alt="CJMEA Logo"/>
        </td>
        <td style="width: 72%;">
            <div style="font-weight: bold;">
                <div style="text-align: right;">{{ $eventversion->short_name }}</div>
                <div style=" text-align: right;">2022 Student Application</div>
            </div>
        </td>
    </tr>
</table>

{{-- ON-SITE APPLICATION ADVISORY --}}
<table style="font-size: .8rem; margin-top: -1rem;">
    <tr style="border: 1px solid red;">
        <td style="color: darkred; text-align: center;border: 1px solid red;">***** ON-SITE APPLICATION *****</td>
    </tr>
</table>

{{-- ADVISORY --}}
<table style="font-size: .8rem;">
    <tr>
        <th style="text-align: center;">
            ALL ENDORSEMENTS MUST BE SIGNED IN INK FOR THIS APPLICATION TO BE ACCEPTED.
        </th>
    </tr>
    <tr>
        <th style="text-align: center;">
            GIVE THE SIGNED ENDORSEMENT TO YOUR TEACHER.
        </th>
    </tr>
    <tr>
        <th style="text-align: center; font-size: .66rem;">
            Page 2 of 2
        </th>
    </tr>
</table>

{{-- STUDENT DETAIL DECLARATION --}}
<style>
    table.detailDeclaration {border-collapse: collapse; margin: auto; margin-bottom: 1rem;}
    table.detailDeclaration td{border: 1px solid black; text-align: center; font-weight: bold;}
</style>
<table class="detailDeclaration">
    <tr>
        <td style="width: 35%;">
            {{ $registrant->student->person->fullName }}
        </td>
        <td style="width: 15%; color: red;">
            {{ strtoupper($registrant->instrumentationsCSV) }}
        </td>
        <td style="width: 20%;">
            Grade: {{ $registrant->student->gradeClassof }}
        </td>
        <td style="width: 30%;">
            {{ strlen($schoolname) < 20
                ? $schoolname
                : substr($schoolname, 0, 20).'...' }}
        </td>
    </tr>
</table>

{{-- PHONES TABLE --}}
<table class="detailDeclaration">
    <thead>
        <tr style="background-color: rgba(0,0,0,.1);">
            <td style="text-align: center; font-weight: normal;">Home Phone</td>
            <td style="text-align: center; font-weight: normal;">Student Cell Phone</td>
            <td style="text-align: center; font-weight: normal;">Parent Phone</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center; font-weight: normal;">
                @if($registrant->student->phoneHome->id)
                    {{ $registrant->student->phoneHome->phone }}
                @else
                    No Home Phone
                @endif
            </td>
            <td style="text-align: center; font-weight: normal;">
                @if($registrant->student->phoneMobile->id)
                    {{ $registrant->student->phoneMobile->phone }}
                @else
                    No Cell Phone
                @endif
            </td>
            <td style="text-align: center; font-weight: normal;">
                @if($registrant->student->guardians->count() &&
                    $registrant->student->guardians->first()->user_id &&
                    $registrant->student->guardians->first()->phoneMobile->id)
                    {{ $registrant->student->guardians->first()->phoneMobile->phone }}
                @else
                    No Parent Phone
                @endif
            </td>
        </tr>
    </tbody>
</table>


{{-- PLEASE NOTE --}}
<table class="endorsements">
    <tr>
        <th style="text-align: left;">
            <span style="text-decoration: underline;">PLEASE NOTE</span>
        </th>
    </tr>
    <tr>
        <td style="text-align: justify;">
            A student will not be excused for any types of performances other than one school performance with the
            corresponding type of CJMEA organization.   For example: If the student is in the CJMEA Region II Chorus, the
            student may be excused from a CJMEA Region II Chorus rehearsal (excluding the dress rehearsal) to perform with
            his/her high school choir.  No one may miss the concert weekend rehearsals for any reason.
        </td>
    </tr>
    <tr>
        <td style="text-align: justify;">
            All students who successfully audition will be charged a $20 acceptance fee which must be paid in full at
            or before the first rehearsal.  This fee will cover the cost involved in the purchase of music.  All fees must
            be paid in cash or by a School or Director's check only.  No parent/guardian checks will be accepted.
        </td>
    </tr>
</table>

{{-- HOME SCHOOL --}}
<table class="endorsements" style="margin-top: 1rem;" >
    <tr>
        <th style="text-align: left;">
            <span style="text-decoration: underline;">ATTENTION HOME SCHOOL STUDENTS AND DIRECTORS</span>
        </th>
    </tr>
    <tr>
        <td style="text-align: justify;">
            Please read the special Home School Instructions included in the information section of the Director's Packet
            BEFORE you complete this form.
        </td>
    </tr>
</table>

{{-- COVID-19 --}}
<table class="endorsements" style="margin-top: 1rem; border: 1px solid darkgray;">
    <tr style="background-color: rgba(0,0,0,.1);">
        <th style="text-align: center; padding: .5rem;">
            COVID-19 ADVISORY
        </th>
    </tr>
    <tr>
        <td style="text-align: justify; padding: .5rem;">
            By registering for/attending this event, I acknowledge that I fully understand the nature and extent of the
            risks presented by COVID-19 due to my in-person attendance at this event, including the risk that COVID-19 may
            lead to severe illness or death. I also understand and acknowledge that there are risks of exposure to COVID-19,
            whether resulting from travel through high-risk areas, the failure of other individuals to follow proper COVID-19
            protocols, such as maintaining proper social distancing and proper hygiene measures, and other such risks.
            While I understand that CJMEA has taken reasonable steps to address the risks presented by COVID-19, I recognize
            that the COVID-19 protocols being utilized at the event may be insufficient to prevent my contracting COVID-19
            and suffering any related injuries, and that I expressly nevertheless assume all of these risks.
        </td>
    </tr>
    <tr>
        <td style="text-align: justify; padding: .5rem;">
            With full knowledge of the risks involved, therefore, I hereby release, waive, and discharge CJMEA, its officers,
            directors, employees, contractors, and agents, from any and all liability, loss, damage, claims, demands, actions,
            and causes of action whatsoever, including reasonable attorneys' fees, directly or indirectly arising out of
            or related to any loss, damage, injury, or death, that may be sustained by me while participating in this event
            or while in, on, or around the event premises that may lead to exposure or harm due to COVID-19.
        </td>
    </tr>
</table>

</body>
</html>
