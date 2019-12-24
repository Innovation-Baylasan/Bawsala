<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app">
    <map-view inline-template>
        <div>
            <header class="fixed top-0 z-10 left-0 flex items-center inline-block left-position-centered justify-center">
                <div class="shadow mt-4 rounded flex justify-between p-2 bg-white">
                    <a href="#" @click="$modal.show('filteringModal')"
                       class="p-2  h-8 w-8 flex items-center justify-center">
                        <img src="{{asset('svg/layer-icon.svg')}}" alt="search what you looking for">
                    </a>
                    <input class="outline-none text-black px-8"
                           type="text"
                           placeholder="Startups">

                    <a href="#" class="p-2 w-8 h-8 bg-red-100 rounded flex items-center justify-center">
                        <img src="{{asset('svg/search-icon.svg')}}" alt="search what you looking for">
                    </a>
                </div>
            </header>

            <nav class="fixed w-24 z-10 bg-white shadow top-0 left-0 h-screen flex flex-col pt-6">
                <div class="px-4 mb-6">
                    <form action="/logout" method="post" id="logout-form">
                        @csrf
                    </form>
                    <avatar img="https://i.pravatar.cc/300" auth="{{Auth::check()}}"></avatar>
                </div>
                <map-categories></map-categories>
                <div class="flex items-center justify-center mt-auto mb-2">
                    <div class="rounded  w-12 h-12 w-16 h-16 bg-red-500 flex items-center justify-center">
                        <img class="" src="{{asset('svg/notify-icon.svg')}}" alt="">
                    </div>
                </div>

            </nav>

            <main>
                <google-map api-key="{{config('app.google_map_key')}}"></google-map>
            </main>
            @include('partials.modals.filteringModal')
        </div>
    </map-view>
</div>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
