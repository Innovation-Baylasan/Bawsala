<h1> Show event </h1>


<br>
<br>
<br>


<a href="{{ route('events.index')  }}"><< Back</a>

<br>
<br>
<br>

<table class="table-auto table">
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>

    <tr>
        <td>ID</td>
        <td>{{ $event->id  }}</td>
    </tr>
    <tr>
        <td>Cover</td>
        <td>
            <img src="{{ $event->cover  }}" alt="">
        </td>
    </tr>
    <tr>
        <td>Entity</td>
        <td>{{ $event->entity->name }}</td>
    </tr>
    <tr>
        <td>Description</td>
        <td> {{ $event->description,50 }} </td>
    </tr>
    <tr>
        <td>Due Date</td>
        <td>
            {{ $event->due_date  }}
        </td>
    </tr>

</table>

