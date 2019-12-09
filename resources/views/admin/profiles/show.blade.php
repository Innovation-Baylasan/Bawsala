<h1> Show Profile </h1>


<br>
<br>
<br>


<a href="{{ route('profiles.index')  }}"><< Back</a>

<br>
<br>
<br>

<table border="1">
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>

    <tr>
        <td>ID</td>
        <td>{{ $data->id  }}</td>
    </tr>
    <tr>
        <td>Entity</td>
        <td>{{ $data->entity->name  }}</td>
    </tr>
    <tr>
        <td>COVER</td>
        <td><img src="{{ URL::to('/')  }}/images/profiles/covers/{{ $data->cover  }}" alt=""></td>
    </tr>
    <tr>
        <td>Logo</td>
        <td><img src="{{ URL::to('/')  }}/images/profiles/logos/{{ $data->Logo  }}" alt=""></td>
    </tr>
    <tr>
        <td>Address</td>
        <td>{{ $data->Address  }}</td>
    </tr>

</table>

