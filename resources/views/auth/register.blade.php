<!DOCTYPE html>
<html lang="en" xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
<head>
    <meta charset="UTF-8">
    <title>Bawsala | Register now</title>
    <link rel="shortcut icon" type="image/jpg" href="/images/fav-icon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app" class="theme-light">
    <register-view inline-template>
        <div class="flex">
            <div class="hidden md:block flex-1 w-1/2 px-16 py-4">
                <Carousel>
                    <slide classes="search-interaction w-3/4 h-3/4 mb-auto">
                        <template v-slot:footer>
                            <h3 class="uppercase text-2xl font-bold mb-4">find out</h3>
                            <p class="text-gray-500 font-hairline capitalize">
                                Find out the industry related places such as co-work spaces,labs and more
                            </p>
                        </template>
                    </slide>
                    <slide classes="map-interaction w-3/4 h-3/4 mb-auto">
                        <template v-slot:footer>
                            <h3 class="uppercase text-2xl font-bold mb-4">Feedback</h3>
                            <p class="text-gray-500 font-hairline capitalize">
                                Get the feedback from others and share yours with others around places.
                            </p>
                        </template>
                    </slide>
                    <slide classes="editor-interaction w-3/4 h-3/4 mb-auto">
                        <template v-slot:footer>
                            <h3 class="uppercase text-2xl font-bold mb-4">Explore</h3>
                            <p class="text-gray-500 font-hairline capitalize">Explore the places,universities and more
                                around you</p>
                        </template>
                    </slide>
                </Carousel>
            </div>

            <div class="flex-1 px-4 md:px-16 py-4 border-l border-gray-100 border-solid">
                <header class="mb-8">
                    <h3 class="text-4xl font-bold">Sign up</h3>
                    <p class="leading-normal font-hairline text-gray-500 pr-10">
                        Join Bawsala now and find the industry related places
                    </p>
                </header>
                <main>
                    @if($errors->any())
                        <ul class="p-2 border border-red-500 rounded mb-2">
                            @foreach($errors->all() as $error)
                                <li class="text-sm error -mt-2 mb-2">{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{route('register')}}"
                          method="post"
                    >

                        @csrf
                        <label class="input-label" for="">name</label>
                        <div class="input">
                            <input type="text" required name="name" value="{{old('name')}}">
                        </div>

                        <label class="input-label" for="">email</label>
                        <div class="input">
                            <input type="text" required name="email" value="{{old('email')}}">
                        </div>

                        <label class="input-label" for="">password</label>
                        <div class="input">
                            <input type="password" name="password">
                        </div>

                        <label class="input-label" for="">password confirmation</label>
                        <div class="input">
                            <input type="password" name="password_confirmation">
                        </div>


                        <p class="text-gray-500">
                            by registering on Bawsala you accept the
                            <a href="/terms" class="text-accent font-bold">Terms of use</a> and
                            the
                            <a href="/policy"
                               class="text-accent font-bold">privacy policy</a>
                            of Bawsala
                        </p>
                        <div class="flex items-center justify-center mt-8">
                            <button class="bg-accent rounded px-4 md:px-20 py-3 outline-none uppercase text-default font-bold">
                                register
                                now
                            </button>
                        </div>
                    </form>
                </main>
            </div>
        </div>
    </register-view>
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
