<h1> All Entities </h1>

<br>


@if($message = Session::get('success'))
    <hr>
    <p>
        {{ $message  }}
    </p>
    <hr>
@endif


<a href="{{ route('entity_tags.create')  }}">Create Entity Tag</a>

<br>
<br>
<br>

<table class="table-auto table">
    <tr>
        <th> id </th>
        <th> entity </th>
        <th> category </th>
        <th> options </th>
    </tr>

    @foreach($entityTag as $row)
        <tr>
            <td> {{ $row->id  }} </td>
            <td> {{ $row->entity->name  }} </td>
            <td> {{ $row->tag->name  }} </td>
            <td>
                <a href="{{ route('entity_tags.show', $row->id)  }}">show</a> |
                <a href="{{ route('entity_tags.edit', $row->id)  }}">edit</a> |
                <form method="POST" action="{{ route('entity_tags.destroy', $row->id)  }}">

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

{!! $entityTag->links() !!}
