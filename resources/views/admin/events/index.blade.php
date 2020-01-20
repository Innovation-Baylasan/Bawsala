<h1> All Events </h1>

<br>


@if($message = Session::get('success'))
    <hr>
    <p>
        {{ $message  }}
    </p>
    <hr>
@endif


<a href="{{ route('events.create')  }}">Create Event</a>

<br>
<br>
<br>

<table class="table-auto table" border="1">
    <tr>
        <th> id </th>
        <th> Creator </th>
        <th> Entity </th>
        <th> Event Name </th>
        <th> Event Picture </th>
        <th> Description </th>
        <th> Application Start </th>
        <th> Application End </th>
        <th> Longitude </th>
        <th> Latitude </th>
    </tr>

    @foreach($event as $row)
        <tr>
            <td> {{ $row->id  }} </td>
            <td> {{ $row->user->name  }} </td>
            <td> {{ $row->entity->name  }} </td>edit
            <td> {{ $row->event_name  }} </td>
            <td> {{ $row->event_picture  }} </td>
            <td> {{ Str::limit($row->description,50)}} </td>
            <td> {{ $row->application_start_datetime  }} </td>
            <td> {{ $row->application_end_datetime  }} </td>
            <td> {{ $row->latitude  }} </td>
            <td> {{ $row->longitude  }} </td>
            <td>
                <input type="checkbox" @if($row->confirm) checked @endif>
            </td>
            <td>
                <a href="{{ route('events.show', $row->id)  }}">show</a> |
                <a href="{{ route('events.edit', $row->id)  }}">edit</a> |
                <form method="POST" action="{{ route('events.destroy', $row->id)  }}">

                    @csrf
                    @method('DELETE')
                    <input type="submit" value="delete" />

                </form>
            </td>
        </tr>
    @endforeach
</table>

<br>
<br>

{!! $event->links() !!}
