@extends('layouts.admin')
@section('content')
    <div class="p-4">

        @if($message = Session::get('success'))
            <div class="alert is-green">
                {{ $message  }}
            </div>
        @endif

        <a class="button" href="{{ route('events.create')  }}">Create Event</a>

        <table class="mt-4 table-striped table" border="1">
            <thead>
            <tr>
                <th> Event Name</th>
                <th> Creator</th>
                <th> Description</th>
            </tr>
            </thead>
            @foreach($events as $event)
                <tr>
                    <td>
                        <a href="{{ route('events.show', $event->id)  }}">
                            {{ $event->name}}
                        </a>
                    </td>
                    <td> {{ $event->name  }} </td>

                    <td> {{ Str::limit($event->description,50)}} </td>
                    <td>
                        <a href="{{ route('events.edit', $event->id)  }}">
                            <form method="POST"
                                  action="{{ route('events.destroy', $event)  }}"
                                  id="remove-event-form-{{$event->id}}"
                            >
                                <a href="#"
                                   onclick="event.preventDefault();
                                           document.getElementById('remove-event-form-{{$event->id}}').submit();"
                                   class="flex items-center justify-center p-2"
                                >
                                    <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                                        <img src="{{asset('/svg/remove-icon.svg')}}" alt="">
                                    </div>
                                    @csrf
                                    @method('DELETE')
                                </a>
                            </form>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $events->links() }}
    </div>

@endsection