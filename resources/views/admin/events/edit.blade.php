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


<form method="POST" action="{{ route('events.update', $event->id)  }}" enctype="multipart/form-data">

    @csrf
    @method('PATCH')

    <label for="entity">Select entity owner</label>
    <select id="entity" name="entity_id" >
        @foreach($entities as $entity)
            <option @if($entity->id == $event->entity->id) selected @endif value="{{ $entity->id  }}">{{ $entity->name }}</option>
        @endforeach
    </select>

    <br>
    <br>

    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ $event->title  }}">

    <br>
    <br>

    <label for="description">Description</label>
    <textarea type="text"
              id="description"
              name="description"
              rows="7">{{ $event->description  }}</textarea>

    <br>
    <br>


    <label for="due_date">Due Date</label>
    <input type="date" id="due_date" name="due_date" value="{{ $event->due_date  }}">

    <br>
    <br>


    <label for="cover">Cover</label>
    <input type="file" id="cover" name="cover">
    <br>
    <img src="{{ $event->cover  }}" alt="">
    <input type="hidden" name="old_cover" value="{{ $event->cover  }}">

    <br>
    <br>

    <input type="submit" value="Update" />

</form>
