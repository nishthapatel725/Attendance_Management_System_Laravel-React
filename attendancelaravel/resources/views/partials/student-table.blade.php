<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Roll. No.</th>
            <th scope="col">Last Name</th>
            <th scope="col">First Name</th>
            <th scope="col">Middle Name</th>
        </tr>
    </thead>
    <tbody>
        @if ($students->isNotEmpty())
            @foreach ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><input type='text' name='{{ $student->id }}' value='{{ $index + 1 }}' /></td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->middle_name }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5">
                    <center>
                        <form method="POST" action="{{ url('/save-rollnumbers') }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="Save" />
                        </form>
                    </center>
                </td>
            </tr>
        @else
            <tr>
                <td colspan="5">No Records Found</td>
            </tr>
        @endif
    </tbody>
</table>
