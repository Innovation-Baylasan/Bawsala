<form action="{{$action ?? route('questions.store')}}" method="POST">
    {{$method ?? ''}}
    @csrf
    <label for="title" class="input-label">Question</label>
    <div class="input">
        <input type="text"
               id="title"
               name="title"
               value="{{old('title',$question->title)}}"
        >
    </div>
    <label for="answer" class="input-label">Answer</label>
    <div class="input">
        <textarea name="answer"
                  id="answer"
                  cols="30"
                  rows="10"
        >{{old('answer',$question->answer)}}</textarea>
    </div>

    <button class="button">{{$buttonText ?? 'Create Question'}}</button>
</form>