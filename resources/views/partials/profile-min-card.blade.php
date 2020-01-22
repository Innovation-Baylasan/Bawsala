<div class="bg-gray-200 rounded overflow-hidden  text-gray-500 h-48 w-48 mx-2">
    <div>
        <img src="{{ $entity->cover}}" alt="">
    </div>
    <div class="flex items-center justify-center">
        {{ $entity->name}}
    </div>
    <a href="{{'@'.$entity->id}}" class="button">Visit Profile</a>
</div>