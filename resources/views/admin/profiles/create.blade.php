<h1> Create Profile </h1>

@if($errors->any())
    <div class="alert is-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error  }} </li>
            @endforeach
        </ul>
    </div>
@endif


<form method="POST" action="{{ route('profiles.store')  }}" enctype="multipart/form-data">

    @csrf

    <label for="entity">Select entity owner</label>
    <select id="entity" name="entity_id" >
        @foreach($entities as $entity)
            <option value="{{ $entity->id  }}">{{ $entity->name }}</option>
        @endforeach
    </select>

    <br>
    <br>

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
