@extends('layouts.admin')

@section('content')
<h1> Create Category </h1>

@if($errors->any())

    <hr>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error  }} </li>
        @endforeach
    </ul>
    <hr>

@endif

<form method="POST" action="{{ route('categories.update', $category->id)  }}" enctype="multipart/form-data">

    @csrf
    @method('PATCH')

    <label for="category">Cateogry Name</label>
    <input type="text" id="category" name="name" value="{{ $category->name  }}">

    <br>
    <br>

    <label for="icon">Icon</label>
    <input type="file" id="icon" name="icon">
    <br>
    <img src="/images/categoryIcon/{{ $category->icon  }}" alt="">
    <input type="hidden" name="old_icon" value="{{ $category->icon  }}">

    <br>
    <br>

    <input type="submit" value="Update"/>

</form>
@endsection