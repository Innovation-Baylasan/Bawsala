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
        <th> cover </th>
        <th> entity_id </th>
        <th> Event Title </th>
        <th> Description </th>
        <th> Due Date </th>
    </tr>

    @foreach($event as $row)
        <tr>
            <td> {{ $row->id  }} </td>
            <td>
                <img src="{{ $row->cover  }}" alt="">
            </td>
            <td> {{ $row->entity->name  }} </td>
            <td> {{ $row->title  }} </td>
            <td> {{ Str::limit($row->description,50)}} </td>
            <td> {{ $row->due_date  }} </td>
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
