@extends('layouts.admin')
@section('content')
    <div class="p-4">
        <h1> All Events </h1>

        <br>


        @if($message = Session::get('success'))
            <hr>
            <p>
                {{ $message  }}
            </p>
            <hr>
        @endif

        <a class="button" href="{{ route('events.create')  }}">Create Event</a>

        <table class="mt-4 table-striped table" border="1">
            <thead>
            <tr>
                <th> Creator</th>
                <th> Entity</th>
                <th> Event Name</th>
                <th> Description</th>
                <th> Application Start</th>
                <th> Application End</th>
            </tr>
            </thead>
            @foreach($events as $event)
                <tr>
                    <td> {{ $event->user->name  }} </td>
                    <td> {{ $event->entity?$event->entity->name  : '--' }} </td>
                    <td> {{ $event->name  }} </td>
                    <td> {{ Str::limit($event->description,50)}} </td>
                    <td> {{ (new \Carbon\Carbon($event->start_date  ))->diffForHumans()}} </td>
                    <td> {{ (new \Carbon\Carbon($event->end_date  ))->diffForHumans()}} </td>
                    <td>
                        <input type="checkbox" @if($event->confirm) checked @endif>
                    </td>
                    <td>
                        <a href="{{ route('events.show', $event->id)  }}">show</a> |
                        <a href="{{ route('events.edit', $event->id)  }}">edit</a> |
                        <form method="POST" action="{{ route('events.destroy', $event->id)  }}">

                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete"/>

                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $events->links() }}
    </div>

@endsection