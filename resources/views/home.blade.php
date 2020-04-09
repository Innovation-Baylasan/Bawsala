<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{config('app.name')}}</title>
    <link rel="shortcut icon" type="image/jpg" href="/images/fav-icon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="theme-light">
<div id="app">
    <map-view inline-template>
        <div>
            @include('partials._home-header')
            <event-card @close="selectedEvent =null"
            :event="selectedEvent"
            v-if="selectedEvent && (showing == 'events')"
            ></event-card>

            <place-profile-card @close="selectedPlace =null"
            v-if="selectedPlace && (showing == 'places')"
            :place="selectedPlace"></place-profile-card>

            <flash message="{{session('message')}}"></flash>

            <main>
                <google-map :places="places"
                            :center="mapCenter"
                @marker-clicked="selectPlace($event.place)"
                api-key="{{config('app.mapKey')}}"
                ></google-map>
            </main>
            <footer class="fixed bottom-0 w-full z-1p-2 flex flex-col">


                @auth()
                <div v-if="showing == 'events'" class="flex justify-center mb-2">
                    <button @click="$modal.show('add-event')" class="button -mx-2 flex items-center">
                        <img class="mx-2" src="/svg/add-event-icon.svg" alt="add event">
                        <span>
                            Add Event
                        </span>
                    </button>
                </div>

                <div v-if="showing == 'places'" class="flex justify-center mb-2">
                    <a href="/entities/create" class="button">Add Place</a>
                </div>
                @endauth
                <div class=" flex justify-center">
                    <div class="bg-default shadow-sm rounded">
                        <a href="#" @click.prevent="showing = 'places'"
                           class="px-4 py-2 inline-block border-r"
                           :class="[showing == 'places' ? 'text-black' : 'text-gray-500']"
                        >Places</a>
                        <a href="#" @click.prevent="showing = 'events'"
                           class="px-4 py-2 inline-block"
                           :class="[showing == 'events' ? 'text-black' : 'text-gray-500']"
                        >Events</a>
                    </div>
                </div>

            </footer>
            @include('partials.modals.settings')
            @include('partials.modals.report-issue')
            @include('partials.modals.add-event')
        </div>
    </map-view>
</div>
<script src="{{asset('js/app.js')}}" defer></script>

</body>
</html>
