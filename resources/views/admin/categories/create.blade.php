@extends('layouts.admin')

@section('content')
    <div class="p-4">
        <h1 class="mb-8"> Create Category </h1>

        @if($errors->any())
            <div class="alert is-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error  }} </li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="POST"
              action="{{ route('categories.store')  }}"
              class="w-3/4"
              enctype="multipart/form-data">

            @csrf

            <label class="input-label" for="category">Category Name</label>
            <div class="input">
                <input type="text" id="category" name="name">
            </div>

            <label class="input-label" for="icon">Icon</label>
            <div class="input">
                <input type="file" id="icon" name="icon">
            </div>

            <button class="button" type="submit">Create</button>

        </form>
    </div>
@endsection