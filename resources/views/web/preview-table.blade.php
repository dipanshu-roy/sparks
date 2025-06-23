<table class="table table-bordered">
    <thead>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $value)
            <tr>
                <td>{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </tbody>
</table>