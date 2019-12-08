<h1> Show User </h1>


<br>
<br>
<br>


<a href="{{ route('users.index')  }}"><< Back</a>

<br>
<br>
<br>

<table border="1">
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>ID</td>
        <td>{{ $data->id  }}</td>
    </tr>
    <tr>
        <td>ROLE</td>
        <td>{{ $data->role_id  }} </td>
    </tr>
    <tr>
        <td>NAME</td>
        <td>{{ $data->name  }} </td>
    </tr>
    <tr>

        <td>EMAIL</td>
        <td>{{ $data->email  }} </td>
    </tr>
    <tr>

        <td>EMAIL VERIFIED AT</td>
        <td>{{ $data->email_verified_at  }} </td>
    </tr>
    <tr>
        <td>PASSWORD</td>
        <td>{{ $data->password  }} </td>
    </tr>
</table>

