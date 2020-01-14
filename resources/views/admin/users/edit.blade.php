@extends('layouts.admin')

@section('content')
    <div class="p-4">
        <h1 class="mb-4">Edit Role </h1>

        @if($errors->any())
            <div class="alert is-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error  }} </li>
                    @endforeach
                </ul>
            </div>
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
                    <option value="user">User</option>
                    <option value="company">Company</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button class="button is-green" type="submit">Update</button>

        </form>
    </div>
@endsection