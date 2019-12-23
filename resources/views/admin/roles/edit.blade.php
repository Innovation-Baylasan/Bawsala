@extends('layouts.admin')

@section('content')
    <h1> Create Role </h1>

@if($errors->any())

    <hr>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error  }} </li>
        @endforeach
    </ul>
    <hr>

@endif

<form method="POST" action="{{ route('roles.update', $role->id)  }}">

    @csrf
    @method('PATCH')

    <label for="role">Role</label>
    <input type="text" id="role" name="role" value="{{ $role->role  }}">

    <br>
    <br>

    <input type="submit" value="Update" />

</form>
@endsection