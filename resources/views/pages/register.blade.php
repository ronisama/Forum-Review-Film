@extends('mainlayout')

@section('maincontent')

<section class="mt-5 p-5">
<form method="POST" action="/register">
    @csrf


    <input type="text" name="username" placeholder="Username">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">

    <button type="submit">Register</button>
</form>

@if ($errors->any())
    <div style="color:red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
</section>
@endsection
