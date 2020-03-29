@extends('layouts.admin')

@section('content')
    <div class="p-4">

        <h1 class="mb-4 border-b border-gray-200 text-xl font-bold"> Dashboard</h1>
        <nav class="flex -mx-2 mb-8 border-b pb-4">
            <a class="w-1/4 py-6 text-center block rounded text-gray-500 mx-2 bg-gray-200"
               href="{{ route('tags.index')  }}">Tags</a>

            <a class="w-1/4 py-6 text-center block rounded text-gray-500 mx-2 bg-gray-200"
               href="{{ route('users.index')  }}">Users</a>

            <a class="w-1/4 py-6 text-center block rounded text-gray-500 mx-2 bg-gray-200"
               href="{{ route('entities.index')  }}">Entities</a>

            <a class="w-1/4 py-6 text-center block rounded text-gray-500 mx-2 bg-gray-200"
               href="{{ route('categories.index')  }}">Categories</a>

            <a class="w-1/4 py-6 text-center block rounded text-gray-500 mx-2 bg-gray-200"
               href="{{ route('events.index')  }}">Events</a>
        </nav>

        <div class="flex -mx-2">
            <div class="flex-1 mx-2">
                <h2 class="text-center">{{ $entitiesPerCategory->options['chart_title'] }}</h2>
                {!! $entitiesPerCategory->renderHtml() !!}
            </div>
            <div class="flex-1 mx-2">
                <h2 class="text-center">{{ $usersPerType->options['chart_title'] }}</h2>
                {!! $usersPerType->renderHtml() !!}
            </div>
        </div>

    </div>
@endsection
@section('javascript')
    {{--{!! $entitiesPerCategory->renderChartJsLibrary() !!}--}}
    {{--{!! $entitiesPerCategory->renderJs() !!}--}}
    {{--{!! $usersPerType->renderJs() !!}--}}
@endsection