<h3>
    <a href="/admin/categories/create">Create Category</a>
</h3>
@forelse($categories as $category)
    <p>
        <a href="{{$category->path}}">{{$category->name}}</a>
    </p>
@empty
    <p>there is no categories for now</p>
@endforelse
