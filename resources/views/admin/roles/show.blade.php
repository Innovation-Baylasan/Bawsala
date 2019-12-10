<h1> Show Role </h1>


<br>
<br>
<br>


<a href="{{ route('roles.index')  }}"><< Back</a>

<br>
<br>
<br>

<table>
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>

    <tr>
        <td>ID</td>
        <td>{{ $data->id  }}</td>
    </tr>
    <tr>
        <td>Role</td>
        <td>{{ $data->name  }}</td>
    </tr>

</table>
