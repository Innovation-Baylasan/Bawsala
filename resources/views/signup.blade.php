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
        <div class="flex-1">
            <div class="lottie"></div>
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
                                                                                                class="text-red-500 font-bold">agreement
                        policy</a> and
                    <a href="#"
                       class="text-red-500 font-bold">privacy policy</a>
                    will be approved and their consequences bear
                </p>

                <div class="flex items-center justify-center mt-8">
                    <button class="bg-red-500 rounded px-20 py-3 outline-none uppercase text-white font-bold">register
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
    let animation = lottie.loadAnimation({
        container: document.querySelector('.lottie'),
        path: '/js/mapInterActions.json',
        renderer: 'svg',
        loop: true,
        autoplay: true,
    })
</script>
</body>
</html>
