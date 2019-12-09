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
        <td>{{ $data->id  }}</td>
    </tr>
    <tr>
        <td>USER</td>
        <td>{{ $data->user->name  }} </td>
    </tr>
    <tr>
        <td>CATEGORY</td>
        <td>{{ $data->category->name  }} </td>
    </tr>
    <tr>
        <td>PROFILE</td>
        <td>{{ $data->profile_id  }} </td>
    </tr>
    <tr>
        <td>Name</td>
        <td>{{ $data->name  }} </td>
    </tr>
    <tr>
        <td>DESCRIPTION</td>
        <td>{{ $data->description  }} </td>
    </tr>
    <tr>
        <td>LOCATION</td>
        <td>{{ json_encode($data->location)  }} </td>
    </tr>
</table>

