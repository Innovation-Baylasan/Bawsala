@extends('layouts.admin')

@section('content')
    <h1> Create User </h1>

    @if($errors->any())

        <hr>
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error  }} </li>
            @endforeach
        </ul>
        <hr>

    @endif

    <form method="POST" action="{{ route('users.store')  }}">

        @csrf

        <label for="name">Enter User Name</label>
        <input type="text" id="name" name="name">

        <br>
        <br>

        <label for="email">Enter User Email</label>
        <input type="email" id="email" name="email">

        <br>
        <br>


        <label for="role">Select user role</label>
        <select id="role" name="role_id">
            @foreach($roles as $role)
                <option value="{{ $role->id  }}">{{ $role->role }}</option>
            @endforeach
        </select>

        <br>
        <br>

        <label for="password">Enter Password</label>
        <input type="password" id="password" name="password">

        <br>
        <br>

        <input type="submit" value="Create User"/>

    </form>
@endsection