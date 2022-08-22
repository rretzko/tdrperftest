<table>
    <thead>

    <tr>
        <th>id</th>
        <th>name</th>
        <th>address1</th>
        <th>address2</th>
        <th>city</th>
        <th>state</th>
        <th>zipcode</th>
        <th>created_at</th>
        <th>updated_at</th>
    </tr>
    </thead>
    <tbody>
    @forelse($schools AS $school)
        <tr>
            <td>{{ $school->id }}</td>
            <td>{{ $school->name }}</td>
            <td>{{ $school->address0 }}</td>
            <td>{{ $school->address1 }}</td>
            <td>{{ $school->city }}</td>
            <td>{{ $school->geostateAbbr }}</td>
            <td>{{ $school->postalcode }}</td>
            <td>{{ $school->created_at }}</td>
            <td>{{ $school->updated_at }}</td>
        </tr>
    @empty
        <tr><td colspan="9">No schools found</td></tr>
    @endforelse
    </tbody>
</table>
