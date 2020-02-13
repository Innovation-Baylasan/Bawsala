<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Campos | Map Eco system</title>
    <link rel="shortcut icon" type="image/jpg" href="/images/fav-icon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="theme-light">
<div id="app">
    <map-view inline-template>
        <div>
            <header class="fixed py-4 w-full z-10 flex -mx-4 justify-end">

                <div v-if="showing == 'places'"
                     class="relative mx-4">
                    <map-categories :initial-categories="{{$categories}}" @category-change="getPlaces"></map-categories>
                </div>

                <search-input class="self-start" :category="selectedCategories" @result-clicked="selectPlace"
                ></search-input>

                <dropdown>
                    <template v-slot:trigger>
                        <div class="rounded-full cursor-pointer mb-4 ml-20 w-12 h-12 overflow-hidden">
                            <img src="https://www.gravatar.com/avatar/?s=200" alt="">
                        </div>
                    </template>
                    <ul class="dropdown">

                        @guest
                        <li class="dropdown-item">
                            <a href="/login">Login</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="/register">Regsiter</a>
                        </li>
                        @endguest
                        @auth

                        @if($authUser->isAdmin())
                            <li class="dropdown-item">
                                <a href="/admin">dashboard</a>
                            </li>
                        @endif
                        <li class="dropdown-item">
                            <a href="#" @click="$modal.show('settings-modal')">settings</a>
                        </li>
                        @if($authUser->isCompany())
                            <li class="dropdown-item">
                                <a href="/account">profile</a>
                            </li>
                        @endif
                        <li class="dropdown-item">
                            <form action="/logout" method="post" id="logout-form">
                                @csrf
                            </form>
                            <a href="#" onclick="document.getElementById('logout-form').submit()"
                            >Logout</a>
                        </li>
                        @endauth
                    </ul>
                </dropdown>
                {{--@guest--}}
                {{--<div class="bg-default rounded overflow-hidden shadow mt-4 mx-2">--}}
                {{--<a class="p-2 px-4 inline-block text-gray-500 border-r border-gray-200"--}}
                {{--href="/register">Regsiter</a>--}}
                {{--<a class="p-2 px-4 inline-block text-gray-500" href="/login">Login</a>--}}
                {{--</div>--}}
                {{--@endguest--}}
                {{--@auth()--}}
                {{--<form action="/logout" method="post" id="logout-form">--}}
                {{--@csrf--}}
                {{--</form>--}}
                {{--<div class="bg-default rounded overflow-hidden shadow mt-4 mx-2">--}}

                {{--@if($authUser->isAdmin())--}}
                {{--<a class="p-2 px-4 inline-block text-gray-500" href="/admin">dashboard</a>--}}
                {{--@endif--}}
                {{--<a class="p-2 px-4 inline-block text-gray-500" href="/account">profile</a>--}}

                {{--<a class="p-2 px-4 inline-block text-gray-500" @click="$modal.show('settings-modal')" href="#">settigs</a>--}}

                {{--<a class="p-2 px-4 inline-block text-gray-500 border-r border-gray-200"--}}
                {{--href="#"--}}
                {{--onclick="document.getElementById('logout-form').submit()"--}}
                {{-->Logout</a>--}}
                {{--</div>--}}
                {{--@endauth()--}}
                {{----}}


            </header>

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
            <footer class="fixed bottom-0 w-full z-1 flex p-2 justify-center ">
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
            </footer>
            @include('partials.modals.settings')
        </div>
    </map-view>
</div>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
