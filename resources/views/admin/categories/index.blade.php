@extends('layouts.admin')

@section('content')
<h1> All Categories </h1>

<br>


@if($message = Session::get('success'))
    <hr>
    <p>
        {{ $message  }}
    </p>
    <hr>
@endif


<a href="{{ route('categories.create')  }}">Create Category</a>

<br>
<br>
<br>

<table border="1">
    <tr>
        <th> id</th>
        <th> name</th>
        <th> icon</th>
    </tr>

    @foreach($categories as $category)
        <tr>
            <td> {{ $category->id  }} </td>
            <td> {{ $category->name  }} </td>
            <td>
                <img src="{{ URL::to('/')  }}/images/categoryIcon/{{ $category->icon  }}" alt="">
            </td>
            <td>
                <a href="{{ route('categories.show', $category->id)  }}">show</a> |
                <a href="{{ route('categories.edit', $category->id)  }}">edit</a> |
                <form method="POST" action="{{ route('categories.destroy', $category->id)  }}">

                    @csrf
                    @method('DELETE')
                    <input type="submit" value="delete"/>

                </form>
            </td>
        </tr>
    @endforeach
</table>

<br>
<br>

{{$categories->links() }}
@endsection