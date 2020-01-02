<h1> Create Event </h1>

@if($errors->any())
    <div class="alert is-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error  }} </li>
            @endforeach
        </ul>
    </div>
@endif


<form method="POST" action="{{ route('events.store')  }}" enctype="multipart/form-data">

    @csrf

    <label for="entity">Select entity owner</label>
    <select id="entity" name="entity_id" >
        @foreach($entities as $entity)
            <option value="{{ $entity->id  }}">{{ $entity->name }}</option>
        @endforeach
    </select>

    <br>
    <br>

    <label for="title">Title *</label>
    <input type="text" id="title" name="title">

    <br>
    <br>

    <label for="description">Description *</label>
    <textarea type="text"
              id="description"
              name="description"
              rows="7"></textarea>

    <br>
    <br>

    <label for="due_date">Event Date *</label>
    <input type="date" id="due_date" name="due_date">

    <br>
    <br>

    <label for="cover">Cover Image *</label>
    <input type="file" id="cover" name="cover">

    <br>
    <br>

    <input type="submit" value="Create" />

</form>
