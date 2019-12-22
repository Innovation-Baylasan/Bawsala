<h1> Show Tag </h1>


<br>
<br>
<br>


<a href="{{ route('tags.index')  }}"><< Back</a>

<br>
<br>

<table border="1">
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>

    <tr>
        <td>ID</td>
        <td>{{ $tag->id  }}</td>
    </tr>
    <tr>
        <td>Tag</td>
        <td>{{ $tag->name  }}</td>
    </tr>

</table>
