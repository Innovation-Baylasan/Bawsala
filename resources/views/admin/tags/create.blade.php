@extends('layouts.admin')

@section('content')

    <div class="p-4">
        <h1> Create Tag </h1>

        @if($errors->any())
            <div class="alert is-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error  }} </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="w-3/4" method="POST" action="{{ route('tags.store')  }}">

            @csrf

            <label class="input-label" for="tag">Tag</label>
            <div class="input">
                <input type="text" id="tag" name="name">
            </div>
            <button class="button" type="submit">Create</button>

        </form>
    </div>
@endsection