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
                    <img class="inline-block w-8 h-8" src="{{asset($category->icon_png)}}" alt="">
                </td>

                <td class="text-center">
                    <img class="inline-block w-8 h-8"
                         src="{{asset($category->icon)}}" alt="">
                </td>
                <td class="flex justify-end">
                    <a href="{{route('categories.edit',$category)}}"
                       class="flex  items-center justify-center p-2"
                    >
                        <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                            <img src="{{asset('/svg/edit-icon.svg')}}" alt="">
                        </div>
                    </a>
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
                    html: "All places under <strong>" + category.name + "</strong> category will be deleted",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#b3b3b3',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value
            )
                {
                    document.getElementById("remove-category-" + category.name).submit()
                }
            })
            }
        </script>
    </x-slot>
</x-admin>