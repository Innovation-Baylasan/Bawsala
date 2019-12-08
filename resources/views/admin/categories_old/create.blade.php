<form action="/admin/categories" method="post">
    @csrf
    <input type="text" name="name">

    <input type="file" name="badge">

    <button type="submit">Save</button>
</form>
