<div>
    <form action="{{route("twoFactor")}}" method="post">
        @csrf
        <input type="token"></input>
        <input type="submit"></input>
    </form>
</div>
