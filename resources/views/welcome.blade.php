<link rel="stylesheet" href="{{asset('css/app.css')}}">
<body>
<div id="app">
    <header class="fixed top-0 left-0 w-full flex items-center justify-center">
        <div class="shadow mt-10 rounded flex p-2 bg-white">
            <input class="outline-none text-black px-8"
                   type="text"
                   placeholder="Startups">

            <a href="#" class="p-2  bg-red-100 rounded">
                <img src="{{asset('svg/search-icon.svg')}}" alt="search what you looking for">
            </a>
        </div>
    </header>

    <nav class="fixed w-24 bg-white shadow top-0 left-0 h-screen flex flex-col pt-10 overflow-y-scroll">
        <div class="px-6 mb-10">
            <img class="rounded-full" src="https://i.pravatar.cc/300" alt="avatar">
        </div>
        <div class="flex flex-col justify-between">
            <a href="" class="flex  items-center justify-center p-3">
                <img  src="{{asset('svg/map-icon.svg')}}" alt="all items on the map">
            </a>
            <a href="" class="flex items-center justify-center p-3 border-l-4 border-solid border-red-500">
                <div class="p-2 flex items-center justify-center  w-12 h-12 rounded -m-2 bg-red-100">
                    <img class="" src="{{asset('svg/startups-icon.svg')}}" alt="">
                </div>
            </a>
            <a href="" class="flex items-center justify-center p-3">
                <div class="p-2 flex items-center justify-center  w-12 h-12 rounded -m-2 bg-gray-100">
                    <img class="" src="{{asset('svg/accelerator-icon.svg')}}" alt="">
                </div>
            </a>
            <a href="" class="flex items-center justify-center p-3">
                <div class="p-2 flex items-center justify-center  w-12 h-12 rounded -m-2 bg-gray-100">
                    <img class="" src="{{asset('svg/search-icon.svg')}}" alt="">
                </div>
            </a>
            <a href="" class="flex items-center justify-center p-3">
                <div class="p-2 flex items-center justify-center  w-12 h-12 rounded -m-2 bg-gray-100">
                    <img class="" src="{{asset('svg/labs-icon.svg')}}" alt="">
                </div>
            </a>
            <a href="" class="flex items-center justify-center p-3">
                <div class="p-2 flex items-center justify-center  w-12 h-12 rounded -m-2 bg-gray-100">
                    <img class="" src="{{asset('svg/investors-icon.svg')}}" alt="">
                </div>
            </a>
            <a href="" class="flex items-center justify-center p-3">
                <div class="p-2 flex items-center justify-center  w-12 h-12 rounded -m-2 bg-gray-100">
                    <img class="" src="{{asset('svg/research-icon.svg')}}" alt="">
                </div>
            </a>

        </div>
        <div class="flex items-center justify-center mt-auto mb-2">
            <div class="rounded  w-12 h-12 w-16 h-16 bg-red-500 flex items-center justify-center">
                <img class="" src="{{asset('svg/notify-icon.svg')}}" alt="">
            </div>
        </div>

    </nav>

    
    <main>
        <img src="{{asset('img/map.jpg')}}" alt="">
    </main>
</div>
</body>