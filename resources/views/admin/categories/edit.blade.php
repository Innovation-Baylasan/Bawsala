@extends('layouts.admin')

@section('content')
    <div class="p-4">

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
        <form class="w-3/4" method="POST" action="{{ route('categories.update', $category->id)  }}"
              enctype="multipart/form-data">

            @csrf
            @method('PATCH')

            <label class="input-label" for="category">Cateogry Name</label>
            <div class="input">
                <input type="text" id="category" name="name" value="{{ $category->name  }}">
            </div>


            <label class="input-label" for="icon">Icon</label>
            <div class="input">
                <input type="file" id="icon" name="icon">
            </div>

            <input type="hidden" name="old_icon" value="{{ $category->icon  }}">


            <img src="/images/categoryIcon/{{ $category->icon  }}" alt="">

            <button class="button is-green" type="submit">Update</button>

        </form>
    </div>
@endsection