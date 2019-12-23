@extends('layouts.admin')

@section('content')
    <div class="p-4">
        <h1> Create Entity </h1>

        @if($errors->any())

            <hr>
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{ $error  }} </li>
                @endforeach
            </ul>
            <hr>

        @endif

        <form method="POST"
              class="w-3/4"
              action="{{ route('entities.store')  }}">

            @csrf

            <label class="input-label" for="user">Select entity owner</label>
            <div class="input">
                <select id="user" name="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id  }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <label class="input-label" for="category">Select entity category</label>
            <div class="input">
                <select id="category" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id  }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <label class="input-label" for="name">Entity Name</label>
            <div class="input">
                <input type="text" id="name" name="name">
            </div>

            <label class="input-label" for="description">Entity Description</label>
            <div class="input">
                <input type="text" id="description" name="description">
            </div>

            <label class="input-label" for="location">Entity Location</label>
            <div class="input">
                <input type="text" id="location" name="location">
            </div>

            <button class="button is-green" type="submit">Create</button>

        </form>
    </div>
@endsection