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
    <h3>Details</h3>
        <table class="table table-striped col-md-12">
            <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user_details[0] }}</td>
                    <td>{{ $user_details[1] }}</td>
                </tr>
            </tbody>
        </table>  
    </div>

    <div class="row mt-4">
    <h3>Geschiedenis</h3>
        <table class="table table-striped col-md-12">
            <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Termijn</th>
                <th scope="col">Opmerkingen</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($user as $key => $item)
                @if ($item['is_active'] === 0)
                <tr>
                    <td>{{ $item['id_toestel'] }}</td>
                    <td>{{ $item['start_datum'] }} - {{ $item['terug_datum'] }}</td>
                    <td>{{ $item['opmerkingen'] }}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>  
    </div>
</div>

@endsection

       