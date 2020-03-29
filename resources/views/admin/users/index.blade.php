@extends('layouts.admin')

@section('content')
    <div class="p-4">
        @if($message = Session::get('success'))
            <div class="alert is-green">
                {{ $message  }}
            </div>
        @endif

        <a class="button" href="{{ route('users.create')  }}">Create User</a>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th> Name</th>
            <th> role</th>
            <th> Email</th>
            <th></th>
        </tr>

        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><a href="{{route('users.show',$user)}}">{{ $user->name  }}</a></td>
                <td class="capitalize"> {{ $user->role}} </td>
                <td> {{ $user->email}} </td>
                <td class="flex">
                    <a href="{{route('users.edit',$user)}}"
                       class="flex  items-center justify-center p-2"
                    >
                        <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                            <img src="{{asset('/svg/edit-icon.svg')}}" alt="">
                        </div>
                    </a>
                    <form method="POST"
                          action="{{ route('users.destroy', $user)  }}"
                          id="remove-user-{{$user->name}}"
                    >
                        <a href="#"
                           onclick="confirmDeletion({{$user}})"
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

    {{$users->links()}}


    <script>
        function confirmDeletion(user) {
            Swal.fire({
                title: 'Are you sure?',
                html: "The user <strong>" + user.name + "</strong> will be deleted, and you can not revert this",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#b3b3b3',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value){
                document.getElementById("remove-user-" + user.name).submit()
            }
        })
        }
    </script>
@endsection