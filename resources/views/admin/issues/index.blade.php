<x-admin>
    <div class="pt-4">
        <table class="table-striped table">

            <thead>
            <tr>
                <th> title</th>
                <th> description</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($issues as $issue)
                <tr>
                    <td><a href="{{route('issues.show',$issue)}}"> {{ $issue->title  }} </a></td>
                    <td> {{ Str::limit($issue->description,50)}} </td>
                    <td>
                        <span class="status is-{{$issue->status}}">{{$issue->status}}</span>
                    </td>
                    <td class="flex items-center">
                        <form method="POST"
                              action="{{ route('issues.destroy', $issue)  }}"
                              id="remove-issue-{{$issue->id}}"
                        >
                            <a href="#"
                               onclick="confirmDeletion({{$issue}})"
                               class="flex items-center justify-center p-2"
                            >
                                <div class="w-8 h-8 flex items-center justify-center p-1 rounded bg-gray-100">
                                    <img src="{{asset('/svg/remove-icon.svg')}}" alt="">
                                </div>
                                @csrf
                                @method('DELETE')
                            </a>
                        </form>

                        <form method="POST"
                              action="{{ route('issues.update', $issue)  }}"
                              id="remove-issue-close-{{$issue->id}}"
                        >
                            <button
                                    onclick="document.getElementById('remove-issue-close-{{$issue->id}}').submit()"
                                    class="button {{$issue->isClosed() ? 'is-success': 'is-danger'}}"
                            >
                                {{$issue->isClosed() ? 'open': 'close'}}

                                @csrf
                                @method('PUT')
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <x-slot name="scripts">
        <script>
            function confirmDeletion(issue) {
                console.log(issue)
                Swal.fire({
                    title: 'Are you sure?',
                    html: "The <strong>" + issue.title + "</strong> issue will be deleted and you can not revert",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#b3b3b3',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value
                    ) {
                        document.getElementById("remove-issue-" + issue.id).submit()
                    }
                })
            }
        </script>
    </x-slot>
</x-admin>