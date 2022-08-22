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
        .page_break { page-break-before: always; }
    </style>
    <title></title>
</head>
<body style="border: 1px solid white; padding: 1rem; ">

{{-- PAGE HEADER --}}
<table>
    <tr>
        <td style="text-align: center; font-size: 1.5rem; font-weight: bold;">
            All-Shore Chorus
        </td>
    </tr>
    <tr>
        <td style="text-align: center; font-size: 1.5rem;">
            {{ $eventversion->name }}
        </td>
    </tr>
    <tr>
        <td style="text-align: center; font-size: .8rem;">Student Audition eApplication
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
            Email:
        </td>
        <td class="data">
            {{ $registrant->student->emailsCsv }}
        </td>
    </tr>
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
            School:
        </td>
        <td class="data">
            {{ $registrant->student->currentSchoolname }}
        </td>
    </tr>
    <tr>
        <td class="label">
            Teacher:
        </td>
        <td class="data">
            {{ $registrant->student->currentTeachername }}
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


{{-- ELIGIBILITY --}}
<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th colspan="2">Eligibility Requirements</th>
    </tr>
    <tr>
        <td class="descr" colspan="2">
            Please read through the 2022 New Jersey All-Shore Chorus Eligibility Requirements by clicking here!
        </td>
    </tr>
    <tr>
        <td class="label">
            <input type="checkbox">
        </td>
        <td class="data">
            I have read them.
        </td>
    </tr>
</table>

{{-- STUDENT RULES AND REGULATIONS --}}
<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th colspan="2">Student Rules and Regulations</th>
    </tr>
    <tr>
        <td class="descr" colspan="2">
            Please read through the 2022 New Jersey All-Shore Chorus Rules and Regulations by clicking here!
        </td>
    </tr>
    <tr>
        <td class="label">
            <input type="checkbox">
        </td>
        <td class="data">
            I have read them carefully.
        </td>
    </tr>
</table>

{{-- USE OF IMAGE --}}
<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th colspan="2">Use of your image</th>
    </tr>
    <tr>
        <td class="descr" colspan="2">
            I understand that my photograph may be taken during rehearsal or
            performance, and possibly posted on the {{ $eventversion->name }}
            social media accounts.
        </td>
    </tr>
    <tr>
        <td class="label">
            <input type="checkbox">
        </td>
        <td class="data">
            I understand and agree.
        </td>
    </tr>
</table>

{{-- ABSENCES --}}
<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th colspan="2">Absences</th>
    </tr>
    <tr>
        <td class="descr" colspan="2">
            While reading these documents, I took note of the fact that all members
            are allowed two absences.  If a student is absent a third time, they are
            automatically dismissed from the chorus.
        </td>
    </tr>
    <tr>
        <td class="descr" colspan="2">
            <span style="font-style: italic;">
                There is one exception.  If a student in 12th grade can provide documentation
            of a music college audition, a third absense will be allowed upon review
            of the {{ $eventversion->name }} committee.
            </span>
        </td>
    </tr>
    <tr>
        <td class="label">
            <input type="checkbox">
        </td>
        <td class="data">
            I understand and agree.
        </td>
    </tr>
</table>

{{-- LATES --}}
<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th colspan="2">Lates</th>
    </tr>
    <tr>
        <td class="descr" colspan="2">
            I took note of the fact that any three "lates" to a rehearsal will count as
            one absence.
        </td>
    </tr>
    <tr>
        <td class="descr" colspan="2">
            <span style="font-style: italic;">
                And yes, one minute late is considered late.
            </span>
        </td>
    </tr>
    <tr>
        <td class="label">
            <input type="checkbox">
        </td>
        <td class="data">
            I understand and agree.
        </td>
    </tr>
</table>

{{-- PAGE-BREAK --}}
{{-- PAGE HEADER --}}
<table class="page_break">
    <tr>
        <td style="text-align: center; font-size: 1.5rem; font-weight: bold;">
            All-Shore Chorus
        </td>
    </tr>
    <tr>
        <td style="text-align: center; font-size: 1.5rem;">
            {{ $eventversion->name }}
        </td>
    </tr>
    <tr>
        <td style="text-align: center; font-size: .8rem;">Student Audition eApplication
        </td>
    </tr>
</table>

<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th colspan="2">Eligibility Requirements</th>
    </tr>
    <tr>
        <td class="descr" colspan="2">
            <ol>
                <li>
                    Any school in Monmouth or Ocean Country with students in grades 9,10,11, or 12
                    may participate in the All-Shore Chorus.
                </li>
                <li>
                    Each member school (that is, each school which separately pays a
                    membership fee) may send a total of up to 25 students to auditions.
                    If several schools share a membership (such as a junior and senior
                    high school) the number of students sent from all of the schools
                    combined may total up to 25 students.  Schools sending more than
                    25 students to auditions will have all of their students disqualified.
                </li>
                <li>
                    All students from a school whose Choral Director does not submit
                    the proper membership forms and audition registration on time are
                    ineligible to participate in the All-Shore Chorus and will not be
                    permitted to audition.
                </li>
                <li>
                    All Students from any school are automatically ineligible to participate
                    in All-Shore Chorus is a qualified judge from the school is not
                    present for the entire day of auditions.  This is normally the Director
                    of the school chorus.  Directors who can be present for only part of
                    the evening must arrange for a substitute for the remainder of the
                    evening.  Each member school must be represented by a separate judge.
                    No exceptions will be made.
                </li>
                <li>
                    All Students must complete a Student Audition Form.  In incomplete,
                    the student will not be allowed to audition.
                </li>
                <li>
                    All students auditioning for the All-Shore Chorus must be regular
                    members of the choir/chorus of their own school.  Only students who
                    are well qualified, well prepared, of good character, and of a
                    reliable nature should be permitted to audition.  Each student who
                    sings in the All-Shore Chorus is required to sign a membership
                    agreement regarding the responsibilities of membership in the chorus.
                    This must also be signed by their parent/guardian, school principal,
                    and Choral Director.
                </li>
                <li>
                    An auditioning student may attend either a junior or senior high
                    school, and she/he must be in grades 9-12.  The student may audition
                    for any one voice part.  She/he will not be re-auditioned for
                    another part.  This is no restriction against male altos or female
                    tenors.
                </li>
                <li>
                    Any student will be disqualified who sings or makes noises in the hallways
                    during auditions.  Students must not wear any school jackets, T-shirts,
                    uniforms, etc., that would identify them as members of All-State,
                    All-Shore, Band, Chorus, Orchestra, etc., or as the recipient of any
                    special musical honor or award.
                </li>
                <li>
                    Schedule preference will be given schools whos audition information
                    are received first.  Once an audition time is assigned, students will
                    be required to audition at the designated time.
                </li>
                <li>
                    Students from the same school must register together and on time.
                    Exceptions may be made if arrangements are made with the Auditions Manager
                    in advance.  ONce auditions have been closed, they will no be re-opened
                    for late-comers.
                </li>
                <li>
                    Results of the auditions will be emailed to the schools as soon as
                    computations are completed.  The Choral Director will receive the
                    audition forms and score sheets for each student who auditioned.
                </li>
                <li>
                    A complete schodule of rehearsal dates is posted on the All-Shore
                    Chorus web site.
                </li>
                <li>
                    Each Choral Director who has any students accepted into All-Shore
                    Chorus MUST assist at one rehearsal minimum or his/her students
                    will not be permitted to audition the following year.
                </li>
            </ol>
        </td>
    </tr>
</table>

{{-- AUDITION PROCEDURES AND INSTRUCTIONS --}}
<table class="detailDeclaration">
    <tr class="sectionHeader">
        <th colspan="2">Audition Procedures and Instructions</th>
    </tr>
    <tr>
        <td class="descr" colspan="2">
            Please see: https://www.allshorechorusnj.com/copy-of-learning-materials
        </td>
    </tr>
    <tr>
        <td class="descr" colspan="2">
            Please see: https://www.allshorechorusnj.com/auditions
        </td>
    </tr>
</table>

{{-- SIGNATURES --}}
<table>
    <tr>
        <td>
            <input type="checkbox" />
        </td>
        <td class="descr">
            {{ $registrant->student->person->fullName }}
        </td>

    </tr>
    <tr>
        <td>
            <input type="checkbox" />
        </td>
        <td class="descr">
            {{ $registrant->student->guardians->first()->person->fullName }}
        </td>

    </tr>
</table>

</body>
</html>
