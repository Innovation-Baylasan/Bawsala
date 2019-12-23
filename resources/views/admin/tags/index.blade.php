@extends('layouts.admin')

@section('content')
    <div class="p-4">
        @if($message = Session::get('success'))
            <hr>
            <p>
                {{ $message  }}
            </p>
            <hr>
        @endif


        <a class="button" href="{{ route('tags.create')  }}">Create Tag</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th> id</th>
            <th> tag</th>
            <th> options</th>
        </tr>
        </thead>

        <tbody>
        @foreach($tag as $row)
            <tr>
                <td> {{ $row->id  }} </td>
                <td> {{ $row->name  }} </td>
                <td>
                    <a href="{{ route('tags.show', $row->id)  }}">show</a> |
                    <a href="{{ route('tags.edit', $row->id)  }}">edit</a> |
                    <form method="POST" action="{{ route('tags.destroy', $row->id)  }}">

                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete"/>

                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    {{ $tag->links() }}
@endsection