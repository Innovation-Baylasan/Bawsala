<h1> All Entities </h1>

<br>


@if($message = Session::get('success'))
    <hr>
    <p>
        {{ $message  }}
    </p>
    <hr>
@endif


<a href="{{ route('entities.create')  }}">Create Entity</a>

<br>
<br>
<br>

<table border="1">
    <tr>
        <th> id </th>
        <th> user </th>
        <th> category </th>
        <th> profile </th>
        <th> name </th>
        <th> description </th>
        <th> location </th>
        <th> options </th>
    </tr>

    @foreach($data as $row)
        <tr>
            <td> {{ $row->id  }} </td>
            <td> {{ $row->user->name  }} </td>
            <td> {{ $row->category->name  }} </td>
            <td> {{ $row->profile_id  }} </td>
            <td> {{ $row->name  }} </td>
            <td> {{ $row->description  }} </td>
            <td> {{ json_encode($row->location)  }} </td>
            <td>
                <a href="{{ route('entities.show', $row->id)  }}">show</a> |
                <a href="{{ route('entities.edit', $row->id)  }}">edit</a> |
                <form method="POST" action="{{ route('entities.destroy', $row->id)  }}">

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

{!! $data->links() !!}
