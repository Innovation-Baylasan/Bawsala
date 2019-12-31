@extends('layouts.admin')

@section('content')
    <create-entity-view inline-template>
        <div class="p-4">
            <h1> Create Entity </h1>

            @if($errors->any())
                <div class="alert is-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error  }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST"
                  class="w-3/4"
                  action="{{ route('entities.store')  }}">

                @csrf

                <label class="input-label" for="user">Select entity owner</label>
                <div class="input">
                    <select id="user" name="user_id">
                        @foreach($users as $user)
                            <option value="{{ $user->id  }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label class="input-label" for="category">Select entity category</label>
                <div class="input">
                    <select id="category" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id  }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label class="input-label" for="name">Entity Name</label>
                <div class="input">
                    <input type="text" id="name" name="name">
                </div>

                <label class="input-label" for="description">Entity Description</label>
                <div class="input">
                    <textarea type="text"
                              id="description"
                              name="description"
                              rows="7"></textarea>
                </div>

                <label class="input-label" for="location">Entity Location</label>
                <div class="w-full h-56 overflow-hidden mb-4 rounded">
                    <location-picker api-key="{{config('app.google_map_key')}}"
                    @marker-placed="setLocation"></location-picker>
                </div>
                <input type="hidden" name="latitude" :value="location.latitude">
                <input type="hidden" name="longitude" :value="location.longitude">
                <button class="button is-green" type="submit">Create</button>

            </form>
        </div>
    </create-entity-view>
@endsection