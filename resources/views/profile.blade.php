<!DOCTYPE html>
<html lang="en" class="min-h-full min-w-screen">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="bg-gray-200 min-h-screen min-w-screen">
<div id="app">
    <div class="flex w-full p-4 -mx-4 relative">
        <aside class="w-1/4 bg-white flex flex-col mx-4 self-start rounded overflow-hidden sticky top-0">
            <header class="flex flex-col justify-center items-center">
                <div class="relative">
                    <img src="https://placeimg.com/640/360/tech" alt="">
                    <div class="bg-white absolute w-full h-12 cover-skewer"></div>
                </div>
                <div class="rounded-full w-40 h-40 overflow-hidden shadow-sm p-2 bg-white -translate-y-50 -mb-16">
                    <img src="https://avatars.dicebear.com/v2/bottts/avatar.svg" alt="">
                </div>
            </header>
            <div class="px-10 flex flex-col">
                <h3 class="uppercase text-xl font-bold text-center mb-4">{{auth()->user()->name }}</h3>
                <div class="flex justify-between mb-4">
                    <span class="text-gray-500">Followers</span>
                    <span class="text-gray-500">Events</span>
                    <span class="text-gray-500">Review</span>
                </div>
                <button class="bg-blue-100 focus:outline-none text-blue-700 py-2 rounded capitalize font-bold mb-8">
                    FOLLOW
                </button>
            </div>
        </aside>

        <div class="w-3/4 flex flex-col mx-4">
            <div class="bg-white p-8 mb-4 rounded">
                <h3 class="uppercase border-b mb-4 border-solid border-gray-100 text-2xl font-bold">
                    Info
                </h3>
                <p class="text-gray-500 mr-8 ">rambled it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
                    more recently with desktorambled it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
                    more recently with deskto</p>
            </div>
            <div class="bg-white p-8 mb-4 rounded">
                <div class="flex flex-col justify-between">
                    <div class="flex flex-1 py-4 items-start border-b border-solid border-gray-100">
                        <img class="rounded shadow-sm w-12 h-12 mr-4" src="https://i.pravatar.cc/300" alt="avatar">
                        <div class="flex-col">
                            <h3 class="capitalize font-bold">Ahmed Adel</h3>
                            <p class=" font-hairline">Professional company, such an awesome service</p>
                            <span class="self-end text-gray-500 text-sm">5 minutes ago</span>
                        </div>
                    </div>
                    <div class="flex flex-1 py-4 items-center">
                        <img class="rounded shadow-sm w-12 h-12 mr-4" src="https://i.pravatar.cc/300" alt="avatar">
                        <div class="border border-gray-100 border-solid flex-1 flex-col p-2 rounded">
                            <textarea class="w-full outline-none" type="text"
                                      placeholder="Leave Comment Or Review Here"></textarea>
                        </div>
                    </div>
                </div>
                <div></div>
            </div>
            <div class="bg-white p-8 rounded">
                <h3 class="uppercase border-b mb-4 border-solid border-gray-100 text-2xl font-bold">
                    Places
                </h3>
                <div class="text-gray-500 flex -mx-2">
                    <div class="w-1/4 mx-2 bg-gray-500 rounded h-48"></div>
                    <div class="w-1/4 mx-2 bg-gray-500 rounded h-48"></div>
                    <div class="w-1/4 mx-2 bg-gray-500 rounded h-48"></div>
                    <div class="w-1/4 mx-2 bg-gray-500 rounded h-48"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
