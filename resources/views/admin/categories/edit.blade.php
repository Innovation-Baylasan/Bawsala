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

<form method="POST" action="{{ route('categories.update', $data->id)  }}" enctype="multipart/form-data">

    @csrf
    @method('PATCH')

    <label for="category">Cateogry Name</label>
    <input type="text" id="category" name="name" value="{{ $data->name  }}">

    <br>
    <br>

    <label for="icon">Icon</label>
    <input type="file" id="icon" name="icon">
    <br>
    <img src="{{ URL::to('/')  }}/images/categoryIcon/{{ $data->icon  }}" alt="">
    <input type="hidden" name="old_icon" value="{{ $data->icon  }}">

    <br>
    <br>

    <input type="submit" value="Update" />

</form>
