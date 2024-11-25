<form method="post" action="{{route('register')}}">

    @csrf
    <input type="name" name="name">
    @error('name')
    {{ $message }}
    @enderror
    <input type="text" name="email">
    @error('email')
    {{ $message }}
    @enderror
    <input type="text" name="password">
    <input type="submit">

</form>
