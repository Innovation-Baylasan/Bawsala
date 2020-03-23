<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bawsala | Admin Dashboard</title>
    <link rel="shortcut icon" type="image/jpg" href="/images/fav-icon.png"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app" class="theme-light">
    <div class="flex flex-1 h-full bg-gray-200">
        <nav class="bg-default shadow-sm w-56 pt-16 pb-2">
            <header class="flex flex-col justify-center items-center mb-12 h-full">
                <div class="rounded-full p-1 mb-4  shadow-sm bg-default">
                    <img class="w-20 h-20" src="/svg/bawsla-icon.svg"
                         alt=""/>
                </div>
                <div class="text-center text-sm">
                    <h3 class="font-bold uppercase">Baylassan Inevation</h3>
                    <p class="text-sm text-gray-500">Mangers/Directors</p>
                </div>
                <div class="flex flex-col flex-1">

                    <a href="/admin" class="flex  items-center p-1 text-sm px-3  fade">
                        <div class="w-10 h-10 flex items-center justify-center  mr-4">
                            <img src="{{asset('svg/users-icon.svg')}}" alt="">
                        </div>
                        <span class="text-gray-500">Dashboard</span>
                    </a>

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

                    <a href="{{route('events.index')}}" class="flex  items-center p-1 text-sm px-3  fade">
                        <div class="w-10 h-10 flex items-center justify-center  mr-4">
                            <img src="{{asset('svg/add-event-icon.svg')}}" alt="">
                        </div>
                        <span class="text-gray-500">Events</span>
                    </a>

                    <a href="{{route('tags.index')}}" class="flex  items-center p-1 text-sm px-3  fade">
                        <div class="w-10 h-10 flex items-center justify-center  mr-4">
                            <img src="{{asset('svg/tags-icon.svg')}}" alt="">
                        </div>
                        <span class="text-gray-500">Tags</span>
                    </a>

                </div>
            </header>
        </nav>

        <div class="flex p-2 flex-1">
            <main class="bg-default shadow-sm flex-1 mr-2">
                @yield('content')
            </main>
            <div class="w-64 flex-col">
                <div class="bg-default shadow-sm mb-2 p-4 flex justify-end">
                    <dropdown>
                        <template v-slot:trigger>
                            <div class="flex flex-col items-center">
                                <div class="rounded-full w-12 h-12  overflow-hidden p-2 bg-default">
                                    <img src="{{"https://www.gravatar.com/avatar/" . md5( strtolower( trim( auth()->user()->email ) ) ) . "?s=100&d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fforum%2Favatars%2Favatar-18.png"}}"
                                         alt="">
                                </div>
                                <h3 class="text-accent capitalize font-bold text-xs leading-tight">{{auth()->user()->name}}</h3>
                            </div>
                        </template>
                        <ul class="dropdown">
                            <li class="dropdown-item">
                                <a href="/">home</a>
                            </li>
                            <li class="dropdown-item">
                                <form action="/logout" method="post" id="logout-form">
                                    @csrf
                                </form>
                                <a href="#" onclick="document.getElementById('logout-form').submit()"
                                >Logout</a>
                            </li>
                        </ul>
                    </dropdown>
                </div>
                <div class="bg-default mb-2  shadow-sm p-4 flex flex-col justify-center">
                    <img class="mb-4" src="{{asset('/images/categories-splash.jpg')}}" alt="">

                    <a href="{{route('entities.create')}}" class="button is-green  font-bold">Add new entity</a>
                </div>
                <div class="bg-default shadow-sm p-4 flex flex-col justify-center">
                    <img class="mb-4" src="{{asset('/svg/notifications-illustration.svg')}}" alt="">
                    <p class="text-center text-gray-700">Recent notifications will be here</p>
                </div>
            </div>
        </div>

        <flash message="{{session('message')}}"></flash>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
@yield('javascript')
</body>
</html>