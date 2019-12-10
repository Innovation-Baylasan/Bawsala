<h1> Show Category </h1>


<br>
<br>
<br>


<a href="{{ route('categories.index')  }}"><< Back</a>

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
        <td>Tag</td>
        <td>{{ $data->name  }}</td>
    </tr>
    <tr>
        <td>Icon</td>
        <td><img src="{{ URL::to('/')  }}/images/categoryIcon/{{ $data->icon  }}" alt=""></td>
    </tr>

</table>
