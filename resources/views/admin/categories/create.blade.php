<h1> Create Category </h1>

@if($errors->any())

    <hr>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error  }} </li>
        @endforeach
    </ul>
    <hr>

@endif

<form method="POST" action="{{ route('categories.store')  }}" enctype="multipart/form-data">

    @csrf

    <label for="name"></label>

    <label for="category">Cateogry Name</label>
    <input type="text" id="category" name="name">

    <br>
    <br>

    <label for="icon">Icon</label>
    <input type="file" id="icon" name="icon">

    <br>
    <br>

    <input type="submit" value="Create" />

</form>
