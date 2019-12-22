@extends('layouts.admin')

@section('content')
    <h1> All Users </h1>

    <br>


    @if($message = Session::get('success'))
        <hr>
        <p>
            {{ $message  }}
        </p>
        <hr>
    @endif


    <a href="{{ route('users.create')  }}">Create User</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th> id</th>
            <th> role</th>
            <th> Name</th>
            <th> Email</th>
            <th></th>
        </tr>

        </thead>
        <tbody>
        @foreach($user as $row)
            <tr>
                <td> {{ $row->id  }} </td>
                <td> {{ $row->role->role ?? ''  }} </td>
                <td><a href="{{route('users.show',$row)}}">{{ $row->name  }}</a></td>
                <td> {{ $row->email  }} </td>
                <td class="flex">
                    <a href="{{route('users.edit',$row)}}"
                       class="flex  items-center justify-center p-2"
                    >
                        <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                            <img src="{{asset('/svg/edit-icon.svg')}}" alt="">
                        </div>
                    </a>
                    <form method="POST"
                          action="{{ route('users.destroy', $row)  }}"
                          id="remove-user-form"
                    >
                        <a href="#"
                           onclick="event.preventDefault();document.getElementById('remove-user-form').submit();"
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

    {{$user->links()}}
@endsection