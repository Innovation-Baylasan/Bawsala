<h1> All Users </h1>

<br>


@if($message = Session::get('success'))
    <hr>
    <p>
        {{ $message  }}
    </p>
    <hr>
@endif


<a href="{{ route('users.create')  }}">Create User</a>

<br>
<br>
<br>

<table border="1">
    <tr>
        <th> id </th>
        <th> role </th>
        <th> Name </th>
        <th> Email </th>
        <th> Email Verified At </th>
        <th> Password </th>
        <th> options </th>
    </tr>

    @foreach($user as $row)
        <tr>
            <td> {{ $row->id  }} </td>
            <td> {{ $row->role->role  }} </td>
            <td> {{ $row->name  }} </td>
            <td> {{ $row->email  }} </td>
            <td> {{ $row->email_verified_at  }} </td>
            <td> {{ $row->password  }} </td>
            <td>
                <a href="{{ route('users.show', $row->id)  }}">show</a> |
                <a href="{{ route('users.edit', $row->id)  }}">edit</a> |
                <form method="POST" action="{{ route('users.destroy', $row->id)  }}">

                    @csrf
                    @method('DELETE')
                    <input type="submit" value="delete" />

                </form>
            </td>
        </tr>
    @endforeach
</table>

<br>
<br>

{!! $user->links() !!}
