<x-app>
    <div>
        <aside class="fixed h-screen  p-2 w-2/5">
            <div class="w-full h-full faq p-8">
                <img src="/images/bawsala-logo.png" class="self-center" alt="">

            </div>
        </aside>
        <section class="ml-2/5 p-16">
            <div class="text-center mb-16">
                <h1 class="text-gray-800 font-bold text-4xl capitalize">How we can help you</h1>

            </div>
            @foreach($questions as $question)
                <Accordion class="{{!$loop->last ? 'border-b': ''}} pb-4" title="{{$question->title}}"
                           body="{{$question->answer}}"
                ></Accordion>
            @endforeach </section>
        <div>

        </div>
    </div>

</x-app>