<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Campos | Map Eco system</title>
    <link rel="shortcut icon" type="image/jpg" href="/img/logo.png"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app">
    <map-view inline-template>
        <div>
            <header class="fixed w-full z-10 flex items-center inline-block justify-center">
                <search-input :category="selectedCategory" @result-clicked="selectPlace"></search-input>
                <place-profile-card @close="selectedPlace =null"
                v-if="selectedPlace"
                :place="selectedPlace"></place-profile-card>
            </header>

            <nav class="fixed w-24 z-10 bg-white shadow top-0 left-0 h-screen flex flex-col pt-6">
                <div class="px-4 mb-6">
                    <form action="/logout" method="post" id="logout-form">
                        @csrf
                    </form>
                    @auth()
                    <avatar img="{{"https://www.gravatar.com/avatar/" . md5( strtolower( trim( auth()->user()->email ) ) ) . "?s=100&d"}}"
                            :auth="{{auth()->check()}}" :user="{{auth()->user()}}"></avatar>
                    @endauth
                    @guest()
                    <avatar img="{{"https://www.gravatar.com/avatar/"  . "?s=120"}}"
                            auth="{{auth()->check()}}"></avatar>
                    @endguest
                </div>
                <map-categories :categories="{{$categories}}" @category-change="getPlaces"></map-categories>
                <div class="flex items-center justify-center mt-auto mb-2">
                    <div class="rounded  w-12 h-12 w-16 h-16 bg-red-500 flex items-center justify-center">
                        <img class="" src="{{asset('svg/notify-icon.svg')}}" alt="">
                    </div>
                </div>

            </nav>

            <main>
                <google-map :places="places"
                            :center="mapCenter"
                @marker-clicked="selectPlace($event.place)"
                api-key="{{config('app.google_map_key')}}"
                ></google-map>
            </main>
            @include('partials.modals.filteringModal')
        </div>
    </map-view>
</div>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
