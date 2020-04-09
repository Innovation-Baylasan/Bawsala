<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login into Bawsala</title>
    <link rel="shortcut icon" type="image/jpg" href="/images/fav-icon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app" class="theme-light">
    <div class="flex">
        <div class="flex-1 w-1/2  py-4 hidden md:block">
            <div class="relative">
                <img class="absolute top-0 left-0" src="{{asset('/images/map-overlay.png')}}" alt="">
                <img class="absolute top-0 left-0" src="{{asset('/images/app-mockup.png')}}" alt="">
            </div>
        </div>

        <div class="flex-1 px-16 py-4">
            <header class="mb-8">
                <h3 class="text-4xl font-bold">Sign in</h3>
                <p class="leading-normal font-hairline text-gray-500 pr-10">
                    Sign in Bawsala now and find the industry related places
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

                <form action="/login" method="post">
                    @csrf
                    <label class="input-label" for="">email</label>
                    <div class="input">
                        <input type="email" name="email">
                    </div>
                    <label class="input-label" for="">password</label>
                    <div class="input">
                        <input type="password" name="password">
                    </div>

                    <p class="text-gray-500">
                        No account ! <a href="/register" class="text-accent font-bold">create one</a>
                    </p>

                    <p class="text-gray-500">
                        Forget your password! <a href="/password/reset" class="text-accent font-bold">reset now</a>
                    </p>

                    <div class="flex items-center justify-center mt-8">
                        <button type="submit"
                                class="button is-wide">
                            Singe
                            In
                        </button>
                    </div>
                </form>
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
