@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <div class="my-4 rounded">
            <create-sub-entity-view inline-template>
                <form method="POST"
                      enctype="multipart/form-data"
                      @submit.prevent="save"
                      action="{{ route('entities.store')  }}">

                    @csrf

                    <div>
                        <div class="flex flex-col md:flex-row">
                            @if($errors->any())
                                <div class="alert is-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li> {{ $error  }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="bg-white mx-4 md:mx-0 mb-4 md:mb-0 shadow-sm rounded overflow-hidden">
                                <div class="flex flex-col justify-center items-center">
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
                                            class="rounded-full relative border border-default self-start m-4 w-40 h-40 overflow-hidden shadow-sm bg-default -translate-y-50 -mb-16"
                                            name="avatar"
                                    @image-changed="setImageToCrop('avatar',$event,1)"
                                    :src="entity.avatar || 'https://www.gravatar.com/avatar/?s=200'"
                                    ></image-picker>
                                </div>

                                <div class="p-4 pt-0">

                                    <div class="flex justify-between">
                                        <div class="w-3/4">
                                            <label class="input-label" for="name">Entity Name</label>
                                            <div class="input">
                                                <input v-model="entity.name" type="text" id="name" name="name">
                                            </div>
                                            <p class="error" v-if="entity.errors.name"
                                               v-text="entity.errors.name[0]"></p>
                                        </div>
                                        <div>
                                            <label class="input-label" for="category">Select entity category</label>
                                            <v-select label="name"
                                                      :options="{{$categories}}"
                                                      :reduce="category => category.id"
                                                      v-model="entity.category_id"
                                            ></v-select>
                                            <p class="error" v-if="entity.errors.category_id"
                                               v-text="entity.errors.category_id[0]"></p>
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
                                    <p class="error" v-if="entity.errors.description"
                                       v-text="entity.errors.description[0]"></p>



                                    <label class="input-label" for="location">Entity Details</label>
                                    <div class="max-w-full h-56 overflow-hidden mb-2">
                                        <wysiwyg placeholder="Enter entity details"
                                                 class="overflow-hidden"
                                                 v-model="entity.details"/>
                                    </div>


                                    <label class="input-label" for="location">Entity Location</label>
                                    <location-picker class="w-full h-56 rounded mb-4"
                                                     api-key="{{config('app.mapKey')}}"
                                    @marker-placed="setLocation"></location-picker>
                                    <p class="error" v-if="entity.errors.longitude"
                                       v-text="entity.errors.longitude[0]"></p>
                                    <input type="hidden" name="latitude" :value="entity.latitude">
                                    <input type="hidden" name="longitude" :value="entity.longitude">
                                </div>
                                @include('partials.modals.CropImageModal')
                            </div>
                            <div class="bg-white shadow-sm rounded overflow-hidden mx-4 flex-1 md:self-start p-4">
                                <label class="input-label" for="category">Tags</label>

                                <v-select multiple push-tags taggable :options="tags"
                                          v-model="entity.tags"
                                          :reduce="reduceTags"
                                          @search="getTags"></v-select>
                            </div>

                        </div>
                        <div class="p-4 my-2 rounded shadow bg-white">
                            <button class="button is-green" :class="{'is-loading' : loading}" type="submit">
                                Create
                            </button>
                        </div>
                    </div>
                </form>

            </create-sub-entity-view>
        </div>
    </div>
@endsection
