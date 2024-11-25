<div>

<form action="{{route('user.login')}}" method="post">
    @csrf
    <input name="email" type="text"></input>
    <input name="password" type="text"></input>

    <input type="submit" value="Click here"></input>

</form>
</div>
