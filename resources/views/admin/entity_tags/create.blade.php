<h1> Create Entity </h1>

@if($errors->any())

    <hr>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error  }} </li>
        @endforeach
    </ul>
    <hr>

@endif

<form method="POST" action="{{ route('entity_tags.store')  }}">

    @csrf

    <label for="entity">Select entity</label>
    <select id="entity" name="entity_id" >
        @foreach($entities as $entity)
            <option value="{{ $entity->id  }}">{{ $entity->name }}</option>
        @endforeach
    </select>

    <br>
    <br>

    <label for="tag">Select tag</label>
    <select id="tag" name="tag_id" >
        @foreach($tags as $tag)
            <option value="{{ $tag->id  }}">{{ $tag->name }}</option>
        @endforeach
    </select>

    <br>
    <br>

    <input type="submit" value="Create" />

</form>
