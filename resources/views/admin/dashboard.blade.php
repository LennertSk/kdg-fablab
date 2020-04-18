@extends('layouts.app_admin')

@section('content')

<div class="container">
    <ul class="nav row my-5 nav-pills nav-justified">
        <li class="nav-item">
            <a class="nav-link active" href="{{ url('/dashboard') }}" >Overzicht</a>
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
        <h3>Alle items</h3>
        <table class="table table-striped table-hover col-md-12">
            <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Naam</th>
                <th scope="col">Specificaties</th>
                <th scope="col">Beschikbaar</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $key => $item)
                <tr>
                <td>{{$item['id_toestel']}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['specificaties']}}</td>
                @if ($item['is_available'] === 1)
                <td>Ja</td>
                @elseif ($item['is_available'] === 2)
                <td class='table__not-available'>In onderhoud</td>
                @else
                <td class='table__not-available'>Ontleend</td>
                @endif
                <td><a href="{{ url('/dashboard/item/' . $item['id']) }}" class="btn admin-btn btn-primary table__btn" role="button">Info</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>    
    </div>

    <div class="row mt-4">
        <div class="col-md-6"><a href="{{ url('dashboard/addItem') }}" class="btn btn-green col-sm-4 float-left" role="button">Item toevoegen</a></div>
    </div>
</div>


@endsection


