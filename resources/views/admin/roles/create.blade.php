@extends('layouts.admin')

@section('content')
    <h1> Create Role </h1>

    @if($errors->any())
        <div class="alert is-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{ $error  }} </li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="{{ route('roles.store')  }}">

        @csrf

        <label for="name"></label>

        <label for="role">Role</label>
        <input type="text" id="role" name="role">

        <br>
        <br>

        <input type="submit" value="Create"/>

    </form>
@endsection