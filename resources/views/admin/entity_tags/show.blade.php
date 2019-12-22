<h1> Show Entity </h1>


<br>
<br>
<br>


<a href="{{ route('entity_tags.index')  }}"><< Back</a>

<br>
<br>
<br>

<table class="table-auto table">
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>ID</td>
        <td>{{ $entityTag->id  }}</td>
    </tr>
    <tr>
        <td>ENTITY</td>
        <td>{{ $entityTag->entity->name  }} </td>
    </tr>
    <tr>
        <td>TAG</td>
        <td>{{ $entityTag->tag->name  }} </td>
    </tr>
</table>

