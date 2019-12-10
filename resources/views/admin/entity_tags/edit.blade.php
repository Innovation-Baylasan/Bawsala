<h1> Edit Entity </h1>

@if($errors->any())

    <hr>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error  }} </li>
        @endforeach
    </ul>
    <hr>

@endif

<form method="POST" action="{{ route('entity_tags.update', $data->id)  }}">

    @csrf
    @method('PATCH')

    <label for="entity">Select entity</label>
    <select id="entity" name="entity_id" >
        @foreach($entities as $entity)
            <option @if($entity->id == $data->entity->id) selected @endif value="{{ $entity->id  }}">{{ $entity->name }}</option>
        @endforeach
    </select>

    <br>
    <br>

    <label for="tag">Select tag</label>
    <select id="tag" name="tag_id" >
        @foreach($tags as $tag)
            <option @if($tag->id == $data->tag->id) selected @endif value="{{ $tag->id  }}">{{ $tag->name }}</option>
        @endforeach
    </select>

    <br>
    <br>

    <input type="submit" value="Update" />

</form>
