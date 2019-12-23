@extends('layouts.admin')

@section('content')
    <h1> Show Tag </h1>


    <br>
    <br>
    <br>


    <a href="{{ route('tags.index')  }}"><< Back</a>

    <br>
    <br>

    <table class="table-auto table">
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>

        <tr>
            <td>ID</td>
            <td>{{ $tag->id  }}</td>
        </tr>
        <tr>
            <td>Tag</td>
            <td>{{ $tag->name  }}</td>
        </tr>

    </table>
@endsection