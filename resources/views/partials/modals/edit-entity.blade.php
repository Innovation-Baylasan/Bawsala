<modal name="edit-entity"
       classes="rounded bg-default overflow-hidden"
       scrollable
       height="auto" xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">

    <edit-sub-entity-view inline-template :initial-entity="{{$entity}}">
        <div>
            <form method="POST"
                  enctype="multipart/form-data"
                  @submit.prevent="save"
                  action="{{ route('entities.store')  }}">

                @csrf
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
                <div class="p-4">
                    <label class="input-label" for="name">Place Name</label>
                    <div class="input">
                        <input v-model="entity.name" type="text" id="name" name="name">
                    </div>
                    <p class="error" v-if="entity.errors.name" v-text="entity.errors.name[0]"></p>

                    <label class="input-label" for="category">Select category</label>
                    <div class="input">
                        <select id="category" v-model="entity.category_id" name="category_id">
                            @foreach($categories as $category)
                                <option
                                        value="{{ $category->id  }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <p class="error" v-if="entity.errors.category_id"
                       v-text="entity.errors.category_id[0]"></p>

                    <label class="input-label" for="description">Description</label>
                    <div class="input">
                                <textarea type="text"
                                          id="description"
                                          v-model="entity.description"
                                          name="description"
                                          rows="7"></textarea>
                    </div>
                    <p class="error" v-if="entity.errors.description"
                       v-text="entity.errors.description[0]"></p>

                    <v-select multiple push-tags taggable :options="tags"
                              v-model="entity.tags"
                              :reduce="reduceTags"
                              @search="getTags"></v-select>

                    <label class="input-label" for="location">Location</label>
                    <location-picker class="w-full h-56 rounded mb-4" api-key="{{config('app.mapKey')}}"
                    @marker-placed="setLocation"></location-picker>
                    <p class="error" v-if="entity.errors.longitude" v-text="entity.errors.longitude[0]"></p>
                    <input type="hidden" name="latitude" :value="entity.latitude">
                    <input type="hidden" name="longitude" :value="entity.longitude">
                    <button class="button is-green" :class="{'is-loading' : loading}" type="submit">Create
                    </button>
                </div>
            </form>
            @include('partials.modals.CropImageModal')
        </div>
    </edit-sub-entity-view>
</modal>
