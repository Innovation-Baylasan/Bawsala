<h1> Edit Entity </h1>

@if($errors->any())

    <hr>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error  }} </li>
        @endforeach
    </ul>
    <hr>

@endif

<form method="POST" action="{{ route('entities.update', $data->id)  }}">

    @csrf
    @method('PATCH')

    @csrf

    <label for="name">Entity Name</label>
    <input type="text" id="name" name="name" value="{{ $data->name  }}">

    <br>
    <br>

    <label for="description">Entity Description</label>
    <input type="text" id="description" name="description" value="{{ $data->description  }}">

    <br>
    <br>

    <label for="location">Entity Location</label>
    <input type="text" id="location" name="location" value="{{ json_encode($data->location) }}">

    <br>
    <br>

    <input type="submit" value="Update" />

</form>
