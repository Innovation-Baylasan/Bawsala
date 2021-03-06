<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app" class="theme-light">
    <div class="flex">
        <div class="flex-1 w-1/2 px-16 py-4">
            <Carousel>
                <slide classes="search-interaction w-3/4 h-3/4 mb-auto">
                    <template v-slot:footer>
                        <h3 class="uppercase text-2xl font-bold mb-4">find out</h3>
                        <p class="text-gray-500 font-hairline capitalize">rambled it to make a type specimen book. It
                            has survived not
                            only five centuries, but also the leap into electronic
                            typesetting, remaining essentially unchanged.</p>
                    </template>
                </slide>
                <slide classes="map-interaction w-3/4 h-3/4 mb-auto">
                    <template v-slot:footer>
                        <h3 class="uppercase text-2xl font-bold mb-4">Communicate</h3>
                        <p class="text-gray-500 font-hairline capitalize">rambled it to make a type specimen book. It
                            has survived not
                            only five centuries, but also the leap into electronic
                            typesetting, remaining essentially unchanged.</p>
                    </template>
                </slide>
                <slide classes="editor-interaction w-3/4 h-3/4 mb-auto">
                    <template v-slot:footer>
                        <h3 class="uppercase text-2xl font-bold mb-4">Explore</h3>
                        <p class="text-gray-500 font-hairline capitalize">rambled it to make a type specimen book. It
                            has survived not
                            only five centuries, but also the leap into electronic
                            typesetting, remaining essentially unchanged.</p>
                    </template>
                </slide>
            </Carousel>
        </div>

        <div class="flex-1 px-16 py-4 border-l border-gray-100 border-solid">
            <header class="mb-8">
                <h3 class="text-4xl font-bold">Sign up</h3>
                <p class="leading-normal font-hairline text-gray-500 pr-10">Here is placed a text the user wants to
                    register to log in to obtain additional features</p>
            </header>
            <main>

                <label class="text-gray-700 capitalize block mb-2" for="">User name</label>
                <div class="border border-gray-300 border-solid rounded flex px-1 flex mb-4">
                    <input class="flex-1 outline-none leading-loose" type="text">
                </div>

                <label class="text-gray-700 capitalize block mb-2" for="">email</label>
                <div class="border border-gray-300 border-solid rounded flex px-1 flex mb-4">
                    <input class="flex-1 outline-none leading-loose" type="text">
                </div>

                <label class="text-gray-700 capitalize block mb-2" for="">password</label>
                <div class="border border-gray-300 border-solid rounded flex px-1 flex mb-4">
                    <input class="flex-1 outline-none leading-loose" type="text">
                </div>

                <label class="text-gray-700 capitalize block mb-2" for="">password confirmation</label>
                <div class="border border-gray-300 border-solid rounded flex px-1 flex mb-4">
                    <input class="flex-1 outline-none leading-loose" type="text">
                </div>

                <label class="text-gray-700 capitalize block mb-2" for="">Register as</label>
                <div class="flex items-center -mx-2 mb-4">
                    <div class="flex mx-2">
                        <input class="appearance-none" name="type" type="radio" id="company">
                        <label class="select-label" for="company">company</label>
                    </div>
                    <div class="flex">
                        <input class="appearance-none" name="type" type="radio" id="user">
                        <label class="select-label" for="user">user</label>
                    </div>
                </div>


                <p class="text-gray-500">
                    Here a text is placed explaining to the user that upon registration, the <a href="#"
                                                                                                class="text-accent font-bold">agreement
                        policy</a> and
                    <a href="#"
                       class="text-accent font-bold">privacy policy</a>
                    will be approved and their consequences bear
                </p>

                <div class="flex items-center justify-center mt-8">
                    <button class="bg-accent rounded px-20 py-3 outline-none uppercase text-default font-bold">register
                        now
                    </button>
                </div>

            </main>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.5.9/lottie_light.min.js"></script>
<script>
    let searchInteraction = lottie.loadAnimation({
        container: document.querySelector('.search-interaction'),
        path: '/js/searchInteraction.json',
        renderer: 'svg',
        loop: true,
    })

    let mapInteracion = lottie.loadAnimation({
        container: document.querySelector('.map-interaction'),
        path: '/js/mapInteraction.json',
        renderer: 'svg',
        loop: true,
    })
    let editorInteraction = lottie.loadAnimation({
        container: document.querySelector('.editor-interaction'),
        path: '/js/editorInteraction.json',
        renderer: 'svg',
        loop: true,
    })
</script>
</body>
</html>
