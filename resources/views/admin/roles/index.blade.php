@extends('layouts.admin')

@section('content')
    <h1> All Roles </h1>

    <br>


    @if($message = Session::get('success'))
        <hr>
        <p>
            {{ $message  }}
        </p>
        <hr>
    @endif


    <a href="{{ route('roles.create')  }}">Create Role</a>

    <br>
    <br>
    <br>

    <table class="table-auto table">
        <tr>
            <th> id</th>
            <th> role</th>
            <th> options</th>
        </tr>

        @foreach($role as $row)
            <tr>
                <td> {{ $row->id  }} </td>
                <td> {{ $row->role  }} </td>
                <td>
                    <a href="{{ route('roles.show', $row->id)  }}">show</a> |
                    <a href="{{ route('roles.edit', $row->id)  }}">edit</a> |
                    <form method="POST" action="{{ route('roles.destroy', $row->id)  }}">

                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete"/>

                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <br>
    <br>

    {!! $role->links() !!}
@endsection