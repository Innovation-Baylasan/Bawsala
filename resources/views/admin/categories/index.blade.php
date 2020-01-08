@extends('layouts.admin')

@section('content')
    <div class="p-4">

        @if($message = Session::get('success'))
            <div class="alert is-green">
                {{ $message  }}
            </div>
        @endif


        <a class="button" href="{{ route('categories.create')  }}">Create Category</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th> name</th>
            <th> icon</th>
            <th> icon png</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    <a href="{{route('categories.show',$category)}}">
                        {{ $category->name  }}
                    </a>
                </td>
                <td class="text-center">
                    <img class="inline-block" src=" {{$category->icon}}" alt="">
                </td>

                <td class="text-center">
                    <img class="inline-block w-8 h-8" src=" {{$category->icon_png}}" alt="">
                </td>
                <td class="flex justify-end">
                    <a href="{{route('categories.edit',$category)}}"
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
    {{$categories->links() }}

@endsection
