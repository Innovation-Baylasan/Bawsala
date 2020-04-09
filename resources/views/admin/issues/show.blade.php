<x-admin>
    <div class="p-4">

        <div class="flex justify-between border-b pb-4 items-center">
            <h2 class="text-lg font-bold">{{$issue->title}}</h2>
            <span class="status is-{{$issue->status}}">{{$issue->status}}</span>
        </div>

        <p class="text-muted mt-6">{{$issue->description}}</p>
    </div>

</x-admin>