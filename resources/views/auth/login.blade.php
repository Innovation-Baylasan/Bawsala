<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id="app">
    <div class="flex">
        <div class="flex-1 w-1/2  py-4">
            <div class="relative">
                <img class="absolute top-0 left-0" src="{{asset('/images/map-overlay.png')}}" alt="">
                <img class="absolute top-0 left-0" src="{{asset('/images/app-mockup.png')}}" alt="">
            </div>
        </div>

        <div class="flex-1 px-16 py-4">
            <header class="mb-8">
                <h3 class="text-4xl font-bold">Sign in</h3>
                <p class="leading-normal font-hairline text-gray-500 pr-10">Here is placed a text the user wants to
                    register to log in to obtain additional features</p>
            </header>
            <main>
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


                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p class="text-sm text-red-500 -mt-2 mb-2">{{$error}}</p>
                        @endforeach
                    @endif

                    <p class="text-gray-500">
                        Here a text is placed explaining to the user that upon registration, the <a href="#"
                                                                                                    class="text-red-500 font-bold">agreement
                            policy</a> and
                        <a href="#"
                           class="text-red-500 font-bold">privacy policy</a>
                        will be approved and their consequences bear
                    </p>

                    <div class="flex items-center justify-between mt-8">
                        <a class="text-red-500 text-sm" href="/password/reset">Forget password ?</a>
                        <button type="submit"
                                class="button is-wide">
                            Sing
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
