<x-app>
    <div>
        <aside class="fixed h-screen bg-gray-100 p-2 w-2/5">
            <div class="w-full h-full terms p-8">
                <img src="/images/bawsala-logo.png" class="self-center" alt="">

            </div>
        </aside>
        <section class="ml-2/5 p-16">
            <h1 class="text-gray-800 font-bold text-4xl">Terms and conditions</h1>
            {!! $terms->value !!}


            <div class="mt-16 flex">
                <img src="/img/logo.png" class="self-center mr-8" alt="">
                <img src="/images/bawsala-logo.png" class="self-center" alt="">
            </div>
        </section>
    </div>

</x-app>