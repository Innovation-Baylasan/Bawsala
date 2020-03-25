@extends('layouts.admin')

@section('content')
    <div class="p-4">
        <h1 class="mb-4">Create User </h1>

        @if($errors->any())
            <div class="alert is-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error  }} </li>
                    @endforeach
                </ul>
            </div>
        @endif


        @include('admin.users._form')
    </div>
@endsection