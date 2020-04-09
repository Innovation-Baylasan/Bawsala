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


        @include('admin.users._form',[
        'endpoint' => route('users.update', $user),
        'method' => method_field('PUT'),
        'buttonText' => 'update user'
        ])

    </div>
</x-admin>