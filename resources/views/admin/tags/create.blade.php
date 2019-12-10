<h1> Create Tag </h1>

@if($errors->any())

    <hr>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error  }} </li>
        @endforeach
    </ul>
    <hr>

@endif

<form method="POST" action="{{ route('tags.store')  }}">

    @csrf

    <label for="name"></label>

    <label for="tag">Tag</label>
    <input type="text" id="tag" name="name">

    <br>
    <br>

    <input type="submit" value="Create" />

</form>
