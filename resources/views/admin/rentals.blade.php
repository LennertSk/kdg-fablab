@extends('layouts.app_admin')

@section('content')

<div class="container">
<ul class="nav row my-5 nav-pills nav-justified">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}" >Overzicht</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ url('/dashboard/ontleningen') }}">Ontleningen</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard/users') }}" >Gebruikers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Terug naar home</a>
        </li>
    </ul>


    <div class="row mt-4">
        <h3>Ontleende items over datum</h3>
        <table class="table table-striped table-hover col-md-12">
            <thead>
            <tr class='te-laat'>
                <th scope="col">Code</th>
                <th scope="col">Naam</th>
                <th scope="col">Start datum</th>
                <th>Eind datum</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($itemsOverdue as $key => $item)
            <tr>
                <td class='te-laat'>{{$item['id_toestel']}}</td>
                <td><a href="{{ url('/dashboard/gebruiker/' . $item['id_ontlener']) }}">{{$item['email_ontlener']}}</a></td>
                <td>{{$item['start_datum']}}</td>
                <td class='te-laat'>{{$item['eind_datum']}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>    
        <h3>Ontleende items</h3>
        <table class="table table-striped table-hover col-md-12">
            <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Naam</th>
                <th scope="col">Start Datum</th>
                <th scope="col">Eind Datum</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rentals as $key => $item)
            <tr>
                <td>{{$item['id_toestel']}}</td>
                <td><a href="{{ url('/dashboard/gebruiker/' . $item['id_ontlener']) }}">{{$item['email_ontlener']}}</a></td>
                <td>{{$item['start_datum']}}</td>
                <td>{{$item['eind_datum']}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>    
    </div>
</div>


@endsection


