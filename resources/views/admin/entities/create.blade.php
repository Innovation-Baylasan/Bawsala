@extends('layouts.admin')

@section('content')
    <create-entity-view inline-template>
        <div>
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
                  class=""
                  enctype="multipart/form-data"
                  action="{{ route('entities.store')  }}">

                @csrf
                <header class="flex flex-col justify-center items-center">
                    <image-picker
                            class="relative"
                            default-image="https://placeimg.com/840/360/tech"
                    ></image-picker>
                    <image-picker
                            class="rounded-full relative border border-white self-start m-4 w-40 h-40 overflow-hidden shadow-sm bg-white -translate-y-50 -mb-16"
                            default-image="https://placeimg.com/640/360/tech"
                    ></image-picker>
                </header>

                <div class="p-4">

                    <div class="flex justify-between">
                        <div class="w-3/4">
                            <label class="input-label" for="name">Entity Name</label>
                            <div class="input">
                                <input type="text" id="name" name="name">
                            </div>
                        </div>
                        <div>
                            <label class="input-label" for="category">Select entity category</label>
                            <div class="input">
                                <select id="category" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id  }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{--<label class="input-label" for="name">Logo|Avatar</label>--}}
                    {{--<div class="input invisible">--}}
                    {{--<input type="file" id="avatar" name="avatar">--}}
                    {{--</div>--}}

                    {{--<label class="input-label" for="name">Cover</label>--}}
                    {{--<div class="input invisible">--}}
                    {{--<input type="file" id="cover" name="cover">--}}
                    {{--</div>--}}

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

                </div>
            </form>
        </div>
    </create-entity-view>
@endsection