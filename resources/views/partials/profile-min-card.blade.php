<div class="bg-gray-200 cursor-pointer rounded overflow-hidden  text-gray-500 h-48 w-48 mx-2">
    <div class="w-full h-full relative">
        <img class=" h-full" src="{{ $entity->cover}}" alt="">
        <div class="absolute inset-0 flex items-center justify-center bg-accent-light">
            <h3 class="text-default">{{$entity->name}}</h3>
        </div>
    </div>
</div>