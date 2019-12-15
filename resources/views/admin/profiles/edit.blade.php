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

<form method="POST" action="{{ route('profiles.update', $profile->id)  }}" enctype="multipart/form-data">

    @csrf
    @method('PATCH')

    <label for="entity">Select entity owner</label>
    <select id="entity" name="entity_id" >
        @foreach($entities as $entity)
            <option @if($entity->id == $profile->entity->id) selected @endif value="{{ $entity->id  }}">{{ $entity->name }}</option>
        @endforeach
    </select>

    <br>
    <br>

    <label for="cover">Icon</label>
    <input type="file" id="cover" name="cover">
    <br>
    <img src="{{ URL::to('/')  }}/images/profiles/covers/{{ $profile->cover  }}" alt="">
    <input type="hidden" name="old_cover" value="{{ $profile->cover  }}">

    <br>
    <br>

    <label for="Logo">Icon</label>
    <input type="file" id="Logo" name="Logo">
    <br>
    <img src="{{ URL::to('/')  }}/images/profiles/logos/{{ $profile->Logo  }}" alt="">
    <input type="hidden" name="old_Logo" value="{{ $profile->Logo  }}">


    <br>
    <br>

    <label for="address">Address</label>
    <input type="text" id="address" name="Address" value="{{ $profile->Address  }}">

    <br>
    <br>

    <input type="submit" value="Update" />

</form>
