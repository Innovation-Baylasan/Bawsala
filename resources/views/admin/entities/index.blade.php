<x-admin>

    <div class="p-4">
        <a class="button text-center" href="{{ route('entities.create')  }}">Create Entity</a>
    </div>
    <table class="table-striped table">
        <thead>
        <tr>
            <th> name</th>
            <th> category</th>
            <th> description</th>
            <th>Verified</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @foreach($entities as $entity)
            <tr>
                <td> {{ $entity->name  }} </td>
                <td> {{ $entity->category->name ?? ''}} </td>
                <td> {{ Str::limit($entity->description,50)}} </td>
                <td>
                    <form action="/admin/entities/{{$entity->id}}/verify"
                          method="POST">
                        @csrf

                        @if($entity->verified)
                            @method('DELETE')
                        @endif

                        <input type="checkbox"
                               class="checkbox border border-gray-500"
                               value="{{$entity->verified ? '1' : '0'}}"
                               @if($entity->verified)
                               checked
                               @endif
                               onChange="this.form.submit()"
                        >
                    </form>
                </td>
                <td class="flex items-center">
                    <a href="{{route('entities.edit',$entity)}}"
                       class="flex  items-center justify-center p-2"
                    >
                        <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                            <img src="{{asset('/svg/edit-icon.svg')}}" alt="">
                        </div>
                    </a>
                    <form method="POST"
                          action="{{ route('entities.destroy', $entity)  }}"
                          id="remove-entity-{{$entity->name}}"
                    >
                        <a href="#"
                           onclick="confirmDeletion({{$entity}})"
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

    {{$entities->links()}}

    <x-slot name="scripts">
        <script>
            function confirmDeletion(entity) {
                console.log(entity)
                Swal.fire({
                    title: 'Are you sure?',
                    html: "The <strong>" + entity.name + "</strong> entity will be deleted and you can not revert",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#b3b3b3',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value
                    ) {
                        document.getElementById("remove-entity-" + entity.name).submit()
                    }
                })
            }
        </script>
    </x-slot>
</x-admin>
