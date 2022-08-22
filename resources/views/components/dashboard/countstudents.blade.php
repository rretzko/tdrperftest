@props([
'dashboard'
])
<div class="dashboardcard">
    <header class="">
        Counts
    </header>
    <div class="dashboardbody">
        <table>

            <tr>
                <td>Students</td>
                <th class="text-right">{{$dashboard->countStudents}}</th>
            </tr>
            <tr>
                <td>Alumni</td>
                <th class="text-right">{{$dashboard->countStudentsAlumni}}</th>
            </tr>
            <tr>
                <td>Current</td>
                <th class="text-right">{{$dashboard->countStudentsCurrent}}</th>
            </tr>
        </table>
    </div>
</div>
