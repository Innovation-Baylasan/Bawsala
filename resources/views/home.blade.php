<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Campos | Map Eco system</title>
    <link rel="shortcut icon" type="image/jpg" href="/img/logo.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="theme-light">
<div id="app">
    <map-view inline-template>
        <div>
            <header class="fixed w-full z-10 flex items-center inline-block justify-center">
                <div>
                    <search-input :category="selectedCategory" @result-clicked="selectPlace"></search-input>
                    <place-profile-card @close="selectedPlace =null"
                    v-if="selectedPlace && (showing == 'places')"
                    :place="selectedPlace"></place-profile-card>
                </div>
                @guest
                <div class="bg-default rounded overflow-hidden shadow mt-4 mx-2">
                    <a class="p-2 px-4 inline-block text-gray-500 border-r border-gray-200"
                       href="/register">Regsiter</a>
                    <a class="p-2 px-4 inline-block text-gray-500" href="/login">Login</a>
                </div>
                @endguest
                @auth()
                <form action="/logout" method="post" id="logout-form">
                    @csrf
                </form>
                <div class="bg-default rounded overflow-hidden shadow mt-4 mx-2">

                    @if($authUser->isAdmin())
                        <a class="p-2 px-4 inline-block text-gray-500" href="/admin">dashboard</a>
                    @endif
                    <a class="p-2 px-4 inline-block text-gray-500" href="/account">profile</a>

                    <a class="p-2 px-4 inline-block text-gray-500 border-r border-gray-200"
                       href="#"
                       onclick="document.getElementById('logout-form').submit()"
                    >Logout</a>
                </div>
                @endauth()
            </header>

            <nav v-if="showing == 'places'"
                 class="bg-default bottom-0 fixed flex flex-col overflow-scroll md:overflow-hidden md:h-screen left-0 md:top-0 md:w-24 pt-4 shadow w-full z-10">
                <div class="px-4 mb-6 hidden md:block">
                    <avatar img="{{"https://www.gravatar.com/avatar/" . md5( strtolower( trim( $authUser->email ) ) ) . "?s=100&d"}}"></avatar>
                </div>
                <map-categories :categories="{{$categories}}" @category-change="getPlaces"></map-categories>
                <div class="flex items-center justify-center px-4 mt-auto mb-2 hidden md:block">
                    <div class="rounded  w-12 h-12 w-16 h-16 border-2 border-solid border-accent flex items-center justify-center">
                        <img class="" src="{{asset('svg/notify-icon.svg')}}" alt="">
                    </div>
                </div>

            </nav>
            <flash message="{{session('message')}}"></flash>
            <main>
                <google-map :places="places"
                            :center="mapCenter"
                @marker-clicked="selectPlace($event.place)"
                api-key="{{config('app.mapKey')}}"
                ></google-map>
            </main>
            <footer class="fixed bottom-0 w-full z-10 flex p-2 justify-center ">
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
            @include('partials.modals.filteringModal')
        </div>
    </map-view>
</div>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
