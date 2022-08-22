<style>
    table {
        border-collapse: collapse;
    }

    td, th {
        border: 1px solid black;
        padding: 0 .25rem;
    }
</style>
<table>
    <theader>
        <tr>
            <th>###</th>
            <th>Student</th>
            <th>Status</th>
            <th>Fee</th>
            <th>Paid</th>
            <th>Due</th>
            <th class="sr-only">Pay</th>
        </tr>
    </theader>
    <tbody>
    @forelse($registrants AS $registrant)
        <tr class="{{ ($loop->iteration % 5) ?  'bg-green-50' : 'bg-white'}}">
            <td class="text-right">{{ $loop->iteration }}</td>
            <td>{{ $registrant['student']['person']->fullNameAlpha }}</td>
            <td>{{ $registrant->registranttypeDescr }}</td>
            <td class="text-right">
                ${{ $eventversion['eventversionconfigs']->registrationfee }}</td>
            <td class="text-right">${{ $registrant->paid() }}</td>
            <td class="text-right">${{ $registrant->due() }}</td>
            <td class="py-0.5">
                <a class="bg-green-200 text-black rounded px-2" href="{{ route('registrant.payments.show',['registrant' => $registrant]) }}">
                    Payment
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td class="text-center" colspan="2">
                No Registrants Found
            </td>
        </tr>
    @endforelse

    </tbody>
</table>
