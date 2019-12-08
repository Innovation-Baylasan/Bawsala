<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Entity</th>
    </tr>
    </thead>
    <tbody>
    @forelse($entities as $entity)
        <tr>
            <td>{{$entity->name}}</td>
            <td>{{$entity->user->name}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">
                <p>there is no entities under this category</p>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

{{$entities->links()}}
