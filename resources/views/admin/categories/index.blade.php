<x-admin>

    <div class="p-4">

        @if($message = Session::get('success'))
            <div class="alert is-green">
                {{ $message  }}
            </div>
        @endif


        <a class="button" href="{{ route('categories.create')  }}">Create Category</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th> name</th>
            <th> icon</th>
            <th> icon png</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    <a href="{{route('categories.show',$category)}}">
                        {{ $category->name  }}
                    </a>
                </td>
                <td class="text-center">
                    <img class="inline-block w-8 h-8" src="{{$category->icon_png}}" alt="">
                </td>

                <td class="text-center">
                    <img class="inline-block w-8 h-8"
                         src="{{$category->icon}}" alt="">
                </td>
                <td class="flex justify-end">
                    <a href="{{route('categories.edit',$category)}}"
                       class="flex  items-center justify-center p-2"
                    >
                        <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                            <img src="{{asset('/svg/edit-icon.svg')}}" alt="">
                        </div>
                    </a>

                    @if(! ($category->entities()->count()))
                        <form method="POST"
                              action="{{ route('categories.destroy', $category->id)  }}"
                              id="remove-category-{{$category->name}}"
                        >
                            <a href="#"

                               onclick="confirmDeletion({{$category}})"
                               class="flex items-center justify-center p-2"
                            >
                                <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                                    <img src="{{asset('/svg/remove-icon.svg')}}" alt="">
                                </div>
                                @csrf
                                @method('DELETE')
                            </a>
                        </form>
                    @else
                        <a href="#"
                           onclick="showDetails({{$category}})"
                           class="flex items-center justify-center p-2"
                        >
                            <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">

                                <svg xmlns="http://www.w3.org/2000/svg" id="_1176" width="28.533" height="28.533"
                                     data-name="1176" viewBox="0 0 28.533 28.533">
                                    <path id="Path_424"
                                          d="M14.266 0a14.267 14.267 0 1 0 14.267 14.266A14.267 14.267 0 0 0 14.266 0zm2.97 22.111q-1.1.435-1.757.662a4.636 4.636 0 0 1-1.524.227 3.038 3.038 0 0 1-2.074-.651 2.1 2.1 0 0 1-.738-1.651 6 6 0 0 1 .054-.8c.037-.271.1-.575.178-.917l.919-3.246c.081-.312.151-.608.207-.883a3.915 3.915 0 0 0 .082-.765 1.177 1.177 0 0 0-.256-.866 1.454 1.454 0 0 0-.982-.243 2.577 2.577 0 0 0-.731.109 9.904 9.904 0 0 0-.639.213l.243-1q.9-.368 1.727-.629a5.1 5.1 0 0 1 1.558-.263 2.981 2.981 0 0 1 2.044.64 2.127 2.127 0 0 1 .717 1.662q0 .212-.05.745a4.986 4.986 0 0 1-.184.979l-.914 3.237a8.79 8.79 0 0 0-.2.889 4.7 4.7 0 0 0-.088.756 1.086 1.086 0 0 0 .289.879 1.616 1.616 0 0 0 1 .234 2.9 2.9 0 0 0 .756-.117 4.3 4.3 0 0 0 .611-.205zm-.162-13.139a2.182 2.182 0 0 1-1.54.594 2.2 2.2 0 0 1-1.546-.594 1.9 1.9 0 0 1-.644-1.441 1.916 1.916 0 0 1 .644-1.444 2.189 2.189 0 0 1 1.546-.6 2.164 2.164 0 0 1 1.54.6 1.946 1.946 0 0 1 0 2.885z"
                                          class="fill-current" data-name="Path 424"/>
                                </svg>

                            </div>
                            @csrf
                            @method('DELETE')
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    {{$categories->links() }}

    <x-slot name="scripts">
        <script>
            function confirmDeletion(category) {
                Swal.fire({
                    title: 'Are you sure?',
                    html: "<strong>" + category.name + "</strong> category will be deleted",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#b3b3b3',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value
                    ) {
                        document.getElementById("remove-category-" + category.name).submit()
                    }
                })
            }

            function showDetails(category) {
                Swal.fire({
                    html: "<strong>" + category.name + "</strong> category is not deletable because there entities under it.",
                    icon: 'info',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#b3b3b3',
                    confirmButtonText: 'Okay'
                })
            }
        </script>
    </x-slot>
</x-admin>