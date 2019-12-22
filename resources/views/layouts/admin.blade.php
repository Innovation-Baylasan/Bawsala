<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app">
    <div class="flex bg-gray-200">
        <nav class="bg-white shadow-sm w-56 py-16">
            <header class="flex flex-col justify-center items-center mb-12">
                <div class="rounded-full mb-4 w-20 h-20 overflow-hidden shadow-sm p-2 bg-white">
                    <img src="https://avatars.dicebear.com/v2/bottts/avatar.svg" alt="">
                </div>
                <div class="text-center text-sm">
                    <h3 class="font-bold uppercase">Baylassan Inevation</h3>
                    <p class="text-sm text-gray-500">Mangers/Directors</p>
                </div>
            </header>
            <div class="flex flex-col justify-between">
                <a href="{{route('users.index')}}" class="flex  items-center p-1 text-sm px-3  fade">
                    <div class="w-10 h-10 flex items-center justify-center  mr-4">
                        <img src="{{asset('svg/users-icon.svg')}}" alt="">
                    </div>
                    <span class="text-gray-500">Users</span>
                </a>

                <a href="{{route('categories.index')}}" class="flex  items-center p-1 text-sm px-3  fade">
                    <div class="w-10 h-10 flex items-center justify-center  mr-4">
                        <img src="{{asset('svg/categories-icon.svg')}}" alt="">
                    </div>
                    <span class="text-gray-500">Categories</span>
                </a>

                <a href="{{route('entities.index')}}" class="flex  items-center p-1 text-sm px-3  fade">
                    <div class="w-10 h-10 flex items-center justify-center  mr-4">
                        <img src="{{asset('svg/entities-icon.svg')}}" alt="">
                    </div>
                    <span class="text-gray-500">Entities</span>
                </a>

                <a href="{{route('tags.index')}}" class="flex  items-center p-1 text-sm px-3  fade">
                    <div class="w-10 h-10 flex items-center justify-center  mr-4">
                        <img src="{{asset('svg/tags-icon.svg')}}" alt="">
                    </div>
                    <span class="text-gray-500">Tags</span>
                </a>
            </div>
        </nav>
        <div class="flex p-2 flex-1">
            <main class="bg-white shadow-sm flex-1 mr-2">
                @yield('content')
            </main>
            <aside class="w-64 flex-col">
                <div class="bg-white shadow-sm  mb-4 p-4 flex justify-end">

                    <div class="flex flex-col items-center mr-4">
                        <div class="rounded-full w-12 h-12  overflow-hidden p-2 bg-white">
                            <img src="{{asset('/svg/notifications-icon.svg')}}" alt="">
                        </div>
                        <h3 class="text-red-500 capitalize font-bold text-xs leading-tight">Notification</h3>
                    </div>

                    <div class="flex flex-col items-center">
                        <div class="rounded-full w-12 h-12  overflow-hidden p-2 bg-white">
                            <img src="https://avatars.dicebear.com/v2/bottts/avatar.svg" alt="">
                        </div>
                        <h3 class="text-red-500 capitalize font-bold text-xs leading-tight">M.Akasha</h3>
                    </div>
                </div>
                <div class="bg-white mb-4  shadow-sm p-4 flex flex-col justify-center">
                    <img class="mb-4" src="{{asset('/images/categories-splash.jpg')}}" alt="">

                    <button class="button is-green font-bold">Add new entity</button>
                </div>
                <div class="bg-white  shadow-sm p-4 flex flex-col justify-center">
                    <img class="mb-4" src="{{asset('/svg/notifications-illustration.svg')}}" alt="">
                    <p class="text-center text-gray-700">Recent notifications will be here</p>
                </div>
            </aside>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
