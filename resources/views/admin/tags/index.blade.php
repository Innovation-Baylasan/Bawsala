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
            <th> tag</th>
            <th> options</th>
        </tr>
        </thead>

        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td> {{ $tag->name  }} </td>
                <td class="flex justify-center">
                    <a href="{{route('tags.edit',$tag)}}"
                       class="flex  items-center justify-center p-2"
                    >
                        <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                            <img src="{{asset('/svg/edit-icon.svg')}}" alt="">
                        </div>
                    </a>
                    <form method="POST"
                          action="{{ route('tags.destroy', $tag)  }}"
                          id="remove-tag-{{$tag->name}}"
                          onclick="confirmDeletion({{$tag}})"
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

    {{ $tags->links() }}

    <script>
        function confirmDeletion(tag) {
            console.log(tag)
            Swal.fire({
                title: 'Are you sure?',
                html: "The <strong>" + tag.label + "</strong> tag will be deleted and you can not revert",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#b3b3b3',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value
        )
            {
                document.getElementById("remove-tag-" + tag.label).submit()
            }
        })
        }
    </script>
@endsection