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
                <search-input></search-input>
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
                <google-map :center="mapCenter" api-key="{{config('app.google_map_key')}}"></google-map>
            </main>
            @include('partials.modals.filteringModal')
        </div>
    </map-view>
</div>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
