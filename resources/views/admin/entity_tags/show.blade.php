<h1> Show Entity </h1>


<br>
<br>
<br>


<a href="{{ route('entity_tags.index')  }}"><< Back</a>

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
        <td>ENTITY</td>
        <td>{{ $data->entity->name  }} </td>
    </tr>
    <tr>
        <td>TAG</td>
        <td>{{ $data->tag->name  }} </td>
    </tr>
</table>

