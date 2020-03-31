<x-admin>
    <div class="p-4">
        @include('admin.faq._form',[
        'action' => route('questions.update',$question),
        'buttonText' => 'Update question',
        'method' => method_field('PUT')
        ])
    </div>
</x-admin>