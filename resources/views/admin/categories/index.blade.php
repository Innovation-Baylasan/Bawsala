<h1> All Categories </h1>

<br>


@if($message = Session::get('success'))
    <hr>
    <p>
        {{ $message  }}
    </p>
    <hr>
@endif


<a href="{{ route('categories.create')  }}">Create Category</a>

<br>
<br>
<br>

<table border="1">
    <tr>
        <th> id </th>
        <th> name </th>
        <th> icon </th>
    </tr>

    @foreach($data as $row)
        <tr>
            <td> {{ $row->id  }} </td>
            <td> {{ $row->name  }} </td>
            <td>
                <img src="{{ URL::to('/')  }}/images/categoryIcon/{{ $row->icon  }}" alt="">
            </td>
            <td>
                <a href="{{ route('categories.show', $row->id)  }}">show</a> |
                <a href="{{ route('categories.edit', $row->id)  }}">edit</a> |
                <form method="POST" action="{{ route('categories.destroy', $row->id)  }}">

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
