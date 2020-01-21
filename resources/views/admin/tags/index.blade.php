@extends('layouts.admin')

@section('content')
    <div class="p-4">
        @if($message = Session::get('message'))
            <div class="alert is-green">
                {{ $message  }}
            </div>
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
                <td class="flex justify-center">
                    <a href="{{route('tags.edit',$row)}}"
                       class="flex  items-center justify-center p-2"
                    >
                        <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                            <img src="{{asset('/svg/edit-icon.svg')}}" alt="">
                        </div>
                    </a>
                    <form method="POST"
                          action="{{ route('tags.destroy', $row)  }}"
                          id="remove-tag-form"
                    >
                        <a href="#"
                           onclick="event.preventDefault();
                                                     document.getElementById('remove-tag-form').submit();"
                           class="flex items-center justify-center p-2"
                        >
                            <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                                <img src="{{asset('/svg/remove-icon.svg')}}" alt="">
                            </div>
                            @csrf
                            @method('DELETE')
                        </a>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    {{ $tag->links() }}
@endsection