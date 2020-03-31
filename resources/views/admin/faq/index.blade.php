<x-admin>
    <div class="p-4">
        <a class="button" href="{{ route('questions.create')  }}">New Question</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th> Question</th>
            <th> answer</th>
            <th> options</th>
        </tr>
        </thead>

        <tbody>
        @foreach($questions as $Question)
            <tr>
                <td> {{ $Question->title  }} </td>
                <td> {{ $Question->answer }} </td>
                <td class="flex justify-center">
                    <a href="{{route('questions.edit',$Question)}}"
                       class="flex  items-center justify-center p-2"
                    >
                        <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                            <img src="{{asset('/svg/edit-icon.svg')}}" alt="">
                        </div>
                    </a>
                    <form method="POST"
                          action="{{ route('questions.destroy', $Question)  }}"
                          id="remove-Question-{{$Question->name}}"
                          onclick="confirmDeletion({{$Question}})"
                          class="flex items-center justify-center p-2"
                    >
                        <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                            <img src="{{asset('/svg/remove-icon.svg')}}" alt="">
                        </div>
                        @csrf
                        @method('DELETE')
                        </a>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $questions->links() }}

</x-admin>