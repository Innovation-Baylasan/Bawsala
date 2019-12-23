@extends('layouts.admin')

@section('content')
    <h1> Admin </h1>

    <br>
    <br>

    <a href="{{ route('roles.index')  }}">Roles</a>
    <br>
    <br>
    <a href="{{ route('tags.index')  }}">Tags</a>
    <br>
    <br>
    <a href="{{ route('users.index')  }}">Users</a>
    <br>
    <br>
    <a href="{{ route('entities.index')  }}">Entities</a>
    <br>
    <br>
    <a href="{{ route('categories.index')  }}">Categories</a>
    <br>
    <br>
    <a href="{{ route('profiles.index')  }}">Profiles</a>
    <br>
    <br>
    <a href="{{ route('entity_tags.index')  }}">Entity Tags</a>
@endsection