<h1> All Profiles </h1>

<br>


@if($message = Session::get('success'))
    <hr>
    <p>
        {{ $message  }}
    </p>
    <hr>
@endif


<a href="{{ route('profiles.create')  }}">Create Profile</a>

<br>
<br>
<br>

<table border="1">
    <tr>
        <th> id </th>
        <th> entity_id </th>
        <th> cover </th>
        <th> logo </th>
        <th> address </th>
    </tr>

    @foreach($profile as $row)
        <tr>
            <td> {{ $row->id  }} </td>
            <td> {{ $row->entity->name  }} </td>
            <td>
                <img src="{{ URL::to('/')  }}/images/profiles/covers/{{ $row->cover  }}" alt="">
            </td>
            <td>
                <img src="{{ URL::to('/')  }}/images/profiles/logos/{{ $row->Logo  }}" alt="">
            </td>
            <td> {{ $row->Address  }} </td>
            <td>
                <a href="{{ route('profiles.show', $row->id)  }}">show</a> |
                <a href="{{ route('profiles.edit', $row->id)  }}">edit</a> |
                <form method="POST" action="{{ route('profiles.destroy', $row->id)  }}">

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

{!! $profile->links() !!}
