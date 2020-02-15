@extends('layouts.admin')

@section('content')
    <div class="p-4">

        @if($errors->any())
            <div class="alert is-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error  }} </li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="POST" action="{{ route('tags.update', $tag->id)  }}">

            @csrf
            @method('PATCH')

            <label class="input-label" for="tag">Tag</label>
            <div class="input">
                <input type="text" id="tag" name="name" value="{{ $tag->name  }}">
            </div>

            <button class="button" type="submit">update</button>

        </form>
    </div>
@endsection