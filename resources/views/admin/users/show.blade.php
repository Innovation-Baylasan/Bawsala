<x-admin>
    <h1> Show User </h1>


    <br>
    <br>
    <br>


    <a href="{{ route('users.index')  }}"><< Back</a>

    <br>
    <br>
    <br>

    <table class="table-auto table">
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>ID</td>
            <td>{{ $user->id  }}</td>
        </tr>
        <tr>
            <td>ROLE</td>
            <td>{{ $user->role_id  }} </td>
        </tr>
        <tr>
            <td>NAME</td>
            <td>{{ $user->name  }} </td>
        </tr>
        <tr>

            <td>EMAIL</td>
            <td>{{ $user->email  }} </td>
        </tr>
        <tr>

            <td>EMAIL VERIFIED AT</td>
            <td>{{ $user->email_verified_at  }} </td>
        </tr>
        <tr>
            <td>PASSWORD</td>
            <td>{{ $user->password  }} </td>
        </tr>
    </table>
</x-admin>