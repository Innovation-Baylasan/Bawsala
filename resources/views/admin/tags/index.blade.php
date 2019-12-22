<h1> All Tags </h1>

<br>


@if($message = Session::get('success'))
    <hr>
    <p>
        {{ $message  }}
    </p>
    <hr>
@endif


<a href="{{ route('tags.create')  }}">Create Tag</a>

<br>
<br>
<br>

<table border="1">
    <tr>
        <th> id </th>
        <th> tag </th>
        <th> options </th>
    </tr>

    @foreach($tag as $row)
        <tr>
            <td> {{ $row->id  }} </td>
            <td> {{ $row->name  }} </td>
            <td>
                <a href="{{ route('tags.show', $row->id)  }}">show</a> |
                <a href="{{ route('tags.edit', $row->id)  }}">edit</a> |
                <form method="POST" action="{{ route('tags.destroy', $row->id)  }}">

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

{!! $tag->links() !!}
