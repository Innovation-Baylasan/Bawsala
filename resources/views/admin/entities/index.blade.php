@extends('layouts.admin')

@section('content')
    <div class="p-4">
        <a class="button text-center" href="{{ route('entities.create')  }}">Create Entity</a>
    </div>
    <table class="table-striped table">
        <thead>
        <tr>
            <th> name</th>
            <th> category</th>
            <th> description</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach($entities as $entity)
            <tr>
                <td> {{ $entity->name  }} </td>
                <td> {{ $entity->category->name ?? ''}} </td>
                <td> {{ Str::limit($entity->description,50)}} </td>
                <td class="flex">
                    <a href="{{route('entities.edit',$entity)}}"
                       class="flex  items-center justify-center p-2"
                    >
                        <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                            <img src="{{asset('/svg/edit-icon.svg')}}" alt="">
                        </div>
                    </a>
                    <form method="POST"
                          action="{{ route('entities.destroy', $entity)  }}"
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

    {{$entity->links()}}
@endsection