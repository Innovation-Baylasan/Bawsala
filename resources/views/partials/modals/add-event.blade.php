<modal name="add-event"
       classes="rounded bg-default overflow-hidden"
       scrollable
       adaptive
       v-cloak
       height="auto" xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <create-event-view inline-template>
        <div>
            <div class="flex flex-col items-center">
                <div class="bg-secondary w-full h-40"></div>
                <div class="bg-white p-4 -translate-y-50 rounded">
                    <img class="w-24 h-24" src="/svg/bawsla-icon.svg" alt="">
                </div>
            </div>
            <form action="post"
                  @submit.prevent="save"
                  class="p-4">
                @csrf
                <label for="" class="input-label">name</label>
                <div class="input"><input v-model="event.name" type="text"></div>
                <p class="error" v-if="event.errors.name" v-text="event.errors.name[0]"></p>

                <label for="" class="input-label">Registration link</label>
                <p class="text-xs text-accent">links should start with (http:// or https://)</p>
                <div class="input"><input v-model="event.link" type="text"></div>
                <p class="error" v-if="event.errors.link" v-text="event.errors.link[0]"></p>

                <label for="" class="input-label">description</label>
                <div class="input"><textarea v-model="event.description" type="text"></textarea></div>
                <p class="error" v-if="event.errors.description" v-text="event.errors.description[0]"></p>

                <label for="" class="input-label">start datetime</label>
                <div class="input">
                    <datetime v-model="event.start_date" type="datetime"></datetime>
                </div>
                <p class="error" v-if="event.errors.start_date" v-text="event.errors.start_date[0]"></p>

                <label for="" class="input-label">end datetime</label>
                <div class="input">
                    <datetime v-model="event.end_date" type="datetime"></datetime>
                </div>
                <p class="error" v-if="event.errors.end_date" v-text="event.errors.end_date[0]"></p>

                <label class="input-label" for="location">Location</label>
                <location-picker class="w-full h-56 rounded mb-4" api-key="{{config('app.mapKey')}}"
                @marker-placed="setLocation"></location-picker>
                <p class="error" v-if="event.errors.latitude" v-text="event.errors.latitude[0]"></p>

                <p class="error" class="error" v-if="event.errors.longitude" v-text="event.errors.longitude[0]"></p>
                <input type="hidden" name="latitude" :value="event.latitude">
                <input type="hidden" name="longitude" :value="event.longitude">

                <div class="flex justify-between">
                    <button type="button" class="button is-muted" @click="$modal.hide('add-event')">Cancel</button>
                    <button type="submit" class="button">add event</button>
                </div>
            </form>
        </div>
    </create-event-view>
</modal>
