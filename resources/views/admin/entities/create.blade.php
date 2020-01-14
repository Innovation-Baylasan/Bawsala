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
                  @submit.prevent="save"
                  action="{{ route('entities.store')  }}">

                @csrf
                <header class="flex flex-col justify-center items-center">
                    <image-picker
                            class="relative"
                    @image-changed="setImageToCrop('cover',$event)"
                    style="height: 360px
                    ;
                        width: 860px
                    ;"
                    name="cover"
                    :src="entity.cover || 'https://placeimg.com/940/360/tech'"
                    ></image-picker>
                    <image-picker
                            class="rounded-full relative border border-white self-start m-4 w-40 h-40 overflow-hidden shadow-sm bg-white -translate-y-50 -mb-16"
                            name="avatar"
                    @image-changed="setImageToCrop('avatar',$event,1)"
                    :src="entity.avatar || 'https://www.gravatar.com/avatar/?s=200'"
                    ></image-picker>
                </header>

                <div class="p-4">

                    <div class="flex justify-between">
                        <div class="w-3/4">
                            <label class="input-label" for="name">Entity Name</label>
                            <div class="input">
                                <input v-model="entity.name" type="text" id="name" name="name">
                            </div>
                        </div>
                        <div>
                            <label class="input-label" for="category">Select entity category</label>
                            <div class="input">
                                <select id="category" v-model="entity.category_id" name="category_id">
                                    @foreach($categories as $category)
                                        <option
                                                value="{{ $category->id  }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <label class="input-label" for="description">Entity Description</label>
                    <div class="input">
                    <textarea type="text"
                              id="description"
                              v-model="entity.description"
                              name="description"
                              rows="7"></textarea>
                    </div>

                    <label class="input-label" for="location">Entity Location</label>
                    <location-picker class="w-full h-56 rounded mb-4" api-key="{{config('app.mapKey')}}"
                    @marker-placed="setLocation"></location-picker>
                    <input type="hidden" name="latitude" :value="entity.latitude">
                    <input type="hidden" name="longitude" :value="entity.longitude">
                    <button class="button is-green" type="submit">Create</button>

                </div>
            </form>
            @include('partials.modals.CropImageModal')
        </div>
    </create-entity-view>
@endsection