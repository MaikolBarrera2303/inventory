@extends("layout.app")

@section("title","Login")

@section("content")

    @include("layout.messages")

    <form method="post" autocomplete="off" action="{{ route("login") }}">
        @csrf
        <label for="user">Email</label>
        <input name="user" type="email" id="user" required>
        <br>

        <label for="password">Contraseña</label>
        <input name="password" type="password" id="password" required>
        <br>

        <input name="remember" type="checkbox" id="remember">
        <label for="remember">Recuerdame</label>
        <br>

        <button type="submit">Ingresar</button>
    </form>

@endsection
