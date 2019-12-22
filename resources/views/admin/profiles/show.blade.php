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
        <td>{{ $profile->id  }}</td>
    </tr>
    <tr>
        <td>Entity</td>
        <td>{{ $profile->entity->name  }}</td>
    </tr>
    <tr>
        <td>COVER</td>
        <td><img src="{{ URL::to('/')  }}/images/profiles/covers/{{ $profile->cover  }}" alt=""></td>
    </tr>
    <tr>
        <td>Logo</td>
        <td><img src="{{ URL::to('/')  }}/images/profiles/logos/{{ $profile->Logo  }}" alt=""></td>
    </tr>
    <tr>
        <td>Address</td>
        <td>{{ $profile->Address  }}</td>
    </tr>

</table>

