<form class="w-3/4" method="POST" action="{{ route('users.store')  }}">

    @csrf

    <label class="input-label" for="name">Name</label>
    <div class="input">
        <input type="text" id="name" value="{{old('name',$user->name)}}" name="name">
    </div>


    <label class="input-label" for="email">Email</label>
    <div class="input">
        <input type="email" id="email" name="email" value="{{old('email',$user->email)}}">
    </div>

    <label class="input-label" for="role">Role</label>
    <div class="input">
        <select id="role" name="role">
            <option value="user" {{old('role',$user->role) ?'selected':''}}>User</option>
            <option value="admin" {{old('role',$user->role) ?'selected':''}}>Admin</option>
        </select>
    </div>


    <label class="input-label" for="password">Enter Password</label>
    <div class="input">
        <input type="password" id="password" name="password">
    </div>

    <label class="input-label" for="password_confirmation">Confirm Password</label>
    <div class="input">
        <input type="password" id="password_confirmation" name="password_confirmation">
    </div>

    <button class="button is-green" type="submit">Create</button>

</form>
