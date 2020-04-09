<x-admin>
    <div class="p-4">
        @if($errors->any())
            <div class="alert is-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error  }} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="w-3/4" method="POST" action="{{ route('categories.update', $category->id)  }}"
              enctype="multipart/form-data">

            @csrf
            @method('PATCH')

            <label class="input-label" for="category">Cateogry Name</label>
            <div class="input">
                <input type="text" id="category" name="name" value="{{ $category->name  }}">
            </div>


            <label class="input-label" for="icon">Icon</label>
            <div class="flex ">
                <div class="input flex-1">
                    <label class="text-center p-2 m-1 rounded bg-accent-light text-accent cursor-pointer" for="icon">Upload
                        File</label>
                    <input class="invisible" type="file" id="icon" name="icon">
                </div>
                <img class="mx-2 w-8 h-8" src="{{asset($category->icon  )}}" alt="">
            </div>

            <label class="input-label" for="icon">Marker</label>
            <div class="flex ">
                <div class="input flex-1">
                    <label class="text-center p-2 m-1 rounded bg-accent-light text-accent cursor-pointer"
                           for="icon_png">Upload
                        File</label>
                    <input class="invisible" type="file" id="icon_png" name="icon_png">
                </div>
                <img class="mx-2 w-8 h-8" src="{{asset($category->icon)}}" alt="">
            </div>


            <button class="button is-green" type="submit">Update</button>

        </form>
    </div>
</x-admin>