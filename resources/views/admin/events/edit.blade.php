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

    <label for="creator_id">Creator</label>
    <input type="text" id="creator_id" value="{{ $event->user->name  }}">

    <br>
    <br>

    <label for="event_name">Event Name</label>
    <input type="text" id="event_name" name="event_name" value="{{ $event->event_name  }}">

    <br>
    <br>

    <label for="event_picture">Event Picture</label>
    <input type="text" id="event_picture" name="event_picture" value="{{ $event->event_picture  }}">

    <br>
    <br>

    <label for="description">Description</label>
    <textarea type="text"
              id="description"
              name="description"
              rows="7">{{ $event->description  }}</textarea>

    <br>
    <br>


    <label for="application_start_datetime">Start Date Time</label>
    <input type="date" id="application_start_datetime" name="application_start_datetime" value="{{ $event->application_start_datetime  }}">

    <br>
    <br>


    <label for="application_end_datetime">End Date Time</label>
    <input type="date" id="application_end_datetime" name="application_end_datetime" value="{{ $event->application_end_datetime  }}">

    <br>
    <br>


    <label for="latitude">Latitude</label>
    <input type="number" id="latitude" name="latitude" value="{{ $event->latitude  }}">

    <br>
    <br>

    <label for="longitude">Longitude</label>
    <input type="number" id="longitude" name="longitude" value="{{ $event->longitude  }}">

    <br>
    <br>

    <label for="confirm">Confirm</label>
    <input type="checkbox" id="confirm" name="confirm" @if($event->confirm) checked @endif>

    <br>
    <br>


    <label for="cover">Cover</label>
    <input type="file" id="cover" name="cover">
    <br>
    <br>

    <img src="{{ $event->cover  }}" alt="">
    <input type="hidden" name="old_cover" value="{{ $event->cover  }}">

    <br>
    <br>

    <input type="submit" value="Update" />

</form>
