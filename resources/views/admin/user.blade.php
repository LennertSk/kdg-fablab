@extends('layouts.app_admin')

@section('content')

<div class="container">
    <ul class="nav row my-5 nav-pills nav-justified">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}" >Overzicht</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard/ontleningen') }}">Ontleningen</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard/users') }}" >Gebruikers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Terug naar home</a>
        </li>
    </ul>
    <div class="row mt-4">
        <table class="table table-striped col-md-12">
            <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Admin</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <form class='col-md-12' method='POST' action='{{ url("dashboard/user/set") }}'>
                @csrf
                <input type="text" name='id' value='{{$user["id"]}}' hidden>
                <td><input type="text" class="form-control" id="name" aria-describedby="name" name="name" value='{{$user["name"]}}'></td>
                <td><input type="email" class="form-control" id="email" aria-describedby="email" name="email" value='{{$user["email"]}}'></td>
                @if ($user["is_admin"])
                <td><input type="checkbox" class="form-control" id="admin" aria-describedby="admin" name="admin" checked="checked" value='1'></td>
                @else
                <td><input type="checkbox" class="form-control" id="admin" aria-describedby="admin" name="admin" value='1'></td>
                @endif
                <td><button type="submit" class="btn admin-btn btn-primary">{{ __('Edit') }}</button></td>
            </form>
            </tr>
            </tbody>
        </table>    
    </div>
</div>

@endsection

       