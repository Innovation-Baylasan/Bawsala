<x-admin>
    <div class="p-4">
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

            <label class="input-label" for="entity">Select entity owner</label>
            <div class="input">
                <select id="entity" name="entity_id">
                    @foreach($entities as $entity)
                        <option value="{{ $entity->id  }}">{{ $entity->name }}</option>
                    @endforeach
                </select>
            </div>

            <label class="input-label" for="title">Title *</label>
            <div class="input">
                <input type="text" id="title" name="title">
            </div>

            <label class="input-label" for="description">Description *</label>
            <div class="input">
            <textarea type="text"
                      id="description"
                      name="description"
                      rows="7"></textarea>
            </div>

            <label class="input-label" for="due_date">Event Date *</label>
            <div class="input">
                <input type="date" id="due_date" name="due_date">
            </div>

            <label class="input-label" for="cover">Cover Image *</label>
            <div class="input">
                <input type="file" id="cover" name="cover">
            </div>

            <button class="button" type="submit">Create</button>

        </form>

    </div>
</x-admin>