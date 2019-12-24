@extends('layouts.admin')

@section('content')
<h1> Edit Entity </h1>
@if($errors->any())
    <div class="alert is-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error  }} </li>
            @endforeach
        </ul>
    </div>
@endif


<form method="POST" action="{{ route('entities.update', $entity->id)  }}">

    @csrf
    @method('PATCH')

    <label for="user">Select entity owner</label>
    <select id="user" name="user_id" >
        @foreach($users as $user)
            <option @if($user->id == $entity->user->id) selected @endif value="{{ $user->id  }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <br>
    <br>

    <label for="category">Select entity category</label>
    <select id="category" name="category_id" >
        @foreach($categories as $category)
            <option @if($category->id == $entity->category->id) selected @endif value="{{ $category->id  }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <br>
    <br>

    <label for="name">Entity Name</label>
    <input type="text" id="name" name="name" value="{{ $entity->name  }}">

    <br>
    <br>

    <label for="description">Entity Description</label>
    <input type="text" id="description" name="description" value="{{ $entity->description  }}">

    <br>
    <br>

    <label for="location">Entity Location</label>
    <input type="text" id="location" name="location" value="{{ json_encode($entity->location) }}">

    <br>
    <br>

    <input type="submit" value="Update" />

</form>
@endsection