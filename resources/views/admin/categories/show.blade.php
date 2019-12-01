<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Entity</th>
    </tr>
    </thead>
    <tbody>
    @forelse($entities as $activity)
        <tr>
            <td>{{$activity->name}}</td>
            <td>{{$activity->company->name}}</td>
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
