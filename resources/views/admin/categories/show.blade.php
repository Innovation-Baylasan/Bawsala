<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Company</th>
    </tr>
    </thead>
    <tbody>
    @forelse($activities as $activity)
        <tr>
            <td>{{$activity->name}}</td>
            <td>{{$activity->company->name}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="100%">
                <p>there is no activities under this category</p>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

{{$activities->links()}}
