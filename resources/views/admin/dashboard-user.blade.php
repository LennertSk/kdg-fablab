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
            <a class="nav-link active" href="{{ url('/dashboard/users') }}" >Gebruikers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Terug naar home</a>
        </li>
    </ul>


    <div class="row mt-4">
        <h3>Gebruikers</h3>
        <table class="table table-striped col-md-12">
            <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Toegang tot dashboard</th>
                <th scope="col" colspan=2>Acties</th>
            </tr>
            </thead>
            <tbody>
            @if (isset($users)) 
            @foreach ($users as $key => $user)
            <tr>
                <td>{{$user['name']}}</td>
                <td>{{$user['email']}}</td>
                @if ($user['is_admin'] === 1)
                <td>Ja</td>
                @else
                <td>Nee</td>
                @endif
                <td><a href="{{ url('/dashboard/user/' . $user['id']) }}" class="btn admin-btn btn-primary" role="button">Edit</a></td>
                <td><a href="{{ url('/dashboard/delete/' . $user['id']) }}" class="btn btn-danger" role="button">Delete</a></td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>    
        <p>Klik <a href="{{ url('/register') }}">hier</a> om een gebruiker bij te maken, nieuwe gebruikers zijn standaard administrators en hebben toegang tot deze pagina. Je kan ze hierboven aanpassen.</p>
    </div>
</div>


@endsection


