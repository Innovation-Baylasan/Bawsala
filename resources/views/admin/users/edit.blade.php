@extends('layouts.admin')

@section('content')
    <div class="p-4">
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

        <form class="w-3/4" method="POST" action="{{ route('users.update', $user->id)  }}">

            @csrf
            @method('PATCH')

            <label class="input-label" for="name">Name</label>
            <div class="input">
                <input type="text" id="name" name="name" value="{{ $user->name  }}">
            </div>

            <label class="input-label" for="email">Email</label>
            <div class="input">
                <input type="email" id="email" name="email" value="{{ $user->email  }}">
            </div>


            <label class="input-label" for="role">Select user role</label>
            <div class="input">
                <select id="role" name="role_id">
                    @foreach($roles as $role)
                        <option @if($role->id == $user->role->id) selected
                                @endif value="{{ $role->id  }}">{{ $role->role }}</option>
                    @endforeach
                </select>
            </div>

            <button class="button is-green" type="submit">Update</button>

        </form>
    </div>
@endsection