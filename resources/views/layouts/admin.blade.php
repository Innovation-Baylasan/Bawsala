<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app">
    <div class="flex bg-gray-300">
        <nav class="bg-white shadow-sm w-56 mr-2 py-16">
            <header class="flex flex-col justify-center items-center mb-8">
                <div class="rounded-full w-20 h-20 overflow-hidden shadow-sm p-2 bg-white">
                    <img src="https://avatars.dicebear.com/v2/bottts/avatar.svg" alt="">
                </div>
                <div class="text-center text-sm">
                    <h3 class="font-bold uppercase">Baylassan Inevation</h3>
                    <p class="text-sm text-gray-500">Mangers/Directors</p>
                </div>
            </header>
            <div class="flex flex-col justify-between">
                <a href="#" class="flex  items-center p-1 text-sm  fade">
                    <div class="w-10 h-10 flex items-center justify-center rounded mr-4">
                        <img src="{{asset('svg/startups-icon.svg')}}" alt="">
                    </div>
                    <span class="text-gray-500">Categories</span>
                </a>

                <a href="#" class="flex  items-center p-1 text-sm  fade">
                    <div class="w-10 h-10 flex items-center justify-center rounded mr-4">
                        <img src="{{asset('svg/entities-icon.svg')}}" alt="">
                    </div>
                    <span class="text-gray-500">Entities</span>
                </a>

                <a href="#" class="flex  items-center p-1 text-sm  fade">
                    <div class="w-10 h-10 flex items-center justify-center rounded mr-4">
                        <img src="{{asset('svg/users-icon.svg')}}" alt="">
                    </div>
                    <span class="text-gray-500">Users</span>
                </a>

                <a href="#" class="flex  items-center p-1 text-sm  fade">
                    <div class="w-10 h-10 flex items-center justify-center rounded mr-4">
                        <img src="{{asset('svg/startups-icon.svg')}}" alt="">
                    </div>
                    <span class="text-gray-500">Settings</span>
                </a>
            </div>
        </nav>
        <main class="bg-white shadow-sm flex-1 mr-2">
            @yield('content')
        </main>
        <aside class="w-64 flex-col">
            <div class="bg-white shadow-sm rounded-b mb-4 p-2 flex justify-end">
                <div class="flex flex-col items-center">
                    <div class="rounded-full w-12 h-12 overflow-hidden p-2 bg-white">
                        <img src="https://avatars.dicebear.com/v2/bottts/avatar.svg" alt="">
                    </div>
                    <h3 class="text-red-500 uppercase font-bold text-xs leading-tight">M.Akasha</h3>
                </div>

            </div>
            <div class="bg-white mb-4"></div>
            <div class="bg-white"></div>
        </aside>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
