<h1> Create Entity </h1>

@if($errors->any())

    <hr>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error  }} </li>
        @endforeach
    </ul>
    <hr>

@endif

<form method="POST" action="{{ route('entities.store')  }}">

    @csrf

    <label for="name">Entity Name</label>
    <input type="text" id="name" name="name">

    <br>
    <br>

    <label for="description">Entity Description</label>
    <input type="text" id="description" name="description">

    <br>
    <br>

    <label for="location">Entity Location</label>
    <input type="text" id="location" name="location">

    <br>
    <br>

    <input type="submit" value="Create" />

</form>
