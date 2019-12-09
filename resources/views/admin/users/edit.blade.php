<h1> Create Role </h1>

@if($errors->any())

    <hr>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error  }} </li>
        @endforeach
    </ul>
    <hr>

@endif

<form method="POST" action="{{ route('users.update', $data->id)  }}">

    @csrf
    @method('PATCH')

    <label for="name">Enter User Name</label>
    <input type="text" id="name" name="name" value="{{ $data->name  }}">

    <br>
    <br>

    <label for="email">Enter User Email</label>
    <input type="email" id="email" name="email" value="{{ $data->email  }}">

    <br>
    <br>


    <label for="role">Select user role</label>
    <select id="role" name="role_id" >
        @foreach($roles as $role)
            <option @if($role->id == $data->role->id) selected @endif value="{{ $role->id  }}">{{ $role->role }}</option>
        @endforeach
    </select>

    <br>
    <br>

    <input type="submit" value="Update" />

</form>
