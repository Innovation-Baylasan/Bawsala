<h1> Show Entity </h1>


<br>
<br>
<br>


<a href="{{ route('entities.index')  }}"><< Back</a>

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
        <td>{{ $entity->id  }}</td>
    </tr>
    <tr>
        <td>USER</td>
        <td>{{ $entity->user->name  }} </td>
    </tr>
    <tr>
        <td>CATEGORY</td>
        <td>{{ $entity->category->name  }} </td>
    </tr>
    <tr>
        <td>PROFILE</td>
        <td>{{ $entity->profile_id  }} </td>
    </tr>
    <tr>
        <td>Name</td>
        <td>{{ $entity->name  }} </td>
    </tr>
    <tr>
        <td>DESCRIPTION</td>
        <td>{{ $entity->description  }} </td>
    </tr>
    <tr>
        <td>LOCATION</td>
        <td>{{ json_encode($entity->location)  }} </td>
    </tr>
</table>

