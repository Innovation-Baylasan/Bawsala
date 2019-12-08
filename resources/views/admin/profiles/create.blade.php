<h1> Create Profile </h1>

@if($errors->any())

    <hr>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error  }} </li>
        @endforeach
    </ul>
    <hr>

@endif

<form method="POST" action="{{ route('profiles.store')  }}" enctype="multipart/form-data">

    @csrf

    <p> After selecting entity </p>

    <label for="cover">Cover Image *</label>
    <input type="file" id="cover" name="cover">

    <br>
    <br>

    <label for="Logo">Logo Image *</label>
    <input type="file" id="Logo" name="Logo">

    <br>
    <br>

    <label for="Address">Address *</label>
    <input type="text" id="Address" name="Address">

    <br>
    <br>

    <input type="submit" value="Create" />

</form>
