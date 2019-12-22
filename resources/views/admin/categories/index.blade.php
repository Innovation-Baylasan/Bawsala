@extends('layouts.admin')

@section('content')
    <div>

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

        <table class="table table-striped">
            <thead>
            <tr>
                <th> id</th>
                <th> name</th>
                <th> icon</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td> {{ $category->id  }} </td>
                    <td>
                        <a href="{{route('categories.show',$category)}}">
                            {{ $category->name  }}
                        </a>
                    </td>
                    <td>
                        <img src="{{ URL::to('/')  }}/images/categoryIcon/{{ $category->icon  }}" alt="">
                    </td>
                    <td class="flex justify-end">
                        <a href="#"
                           class="flex  items-center justify-center p-2"
                        >
                            <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                                <img src="{{asset('/svg/edit-icon.svg')}}" alt="">
                            </div>
                        </a>
                        <form method="POST"
                              action="{{ route('categories.destroy', $category->id)  }}"
                              id="remove-category-form"
                        >
                            <a href="#"
                               onclick="event.preventDefault();
                                                     document.getElementById('remove-category-form').submit();"
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

        <br>
        <br>

        {{$categories->links() }}
    </div>

@endsection