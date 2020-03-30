@extends('layouts.app')

@section('content')
    <div class="container mx-auto bg-white rounded my-4 shadow-sm p-2">
       <div class="w-3/5 mx-auto">
           <div class="text-center mb-16">
               <h1 class="text-bold text-2xl text-gray-900">FAQ</h1>
               <p class="text-gray-600">It's okay. From time to time, we all have questions.</p>
           </div>
           @foreach($questions as $question)
               <Accordion title="{{$question->title}}"
                          body="{{$question->answer}}"
               ></Accordion>
           @endforeach
       </div>
    </div>
@endsection