{{--$table->unsignedBigInteger('user_id');--}}
{{--$table->unsignedBigInteger('category_id');--}}
{{--$table->unsignedBigInteger('profile_id')->nullable();--}}
{{--$table->string('name');--}}
{{--$table->text('description');--}}
{{--$table->json('location');--}}

<form method="POST" action="">

    <label for="name"></label>
    <input type="text" id="name">

    <br>

    <label for="description"></label>
    <input type="text" id="description" name="description">

    <br>

    <label for="longitude"></label>
    <input type="text" id="longitude" name="longitude">

    <br>


    <label for="latitude"></label>
    <input type="text" id="latitude" name="latitude">

    <br>
    <br>

    <input type="submit" value="Create" />

</form>
