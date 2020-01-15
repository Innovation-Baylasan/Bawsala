@extends('layouts.admin')

@section('content')
    <h1> Dashboard</h1>

    <a href="{{ route('tags.index')  }}">Tags</a>

    <a href="{{ route('users.index')  }}">Users</a>

    <a href="{{ route('entities.index')  }}">Entities</a>

    <a href="{{ route('categories.index')  }}">Categories</a>

    <a href="{{ route('profiles.index')  }}">Profiles</a>

    <a href="{{ route('events.index')  }}">Events</a>

@endsection
