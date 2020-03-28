@extends('layouts.app')

@section('content')

<?php // dd($date) ?>


<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <ol class="progressbar">
                <li class="is-complete" data-step="&#10004;">Items Selecteren</li>
                <li class="is-complete" data-step="2">Datum Kiezen</li>
                <li class="is-complete" data-step="3">Registreren</li>
                <li class="progressbar__last is-active" data-step="4">Bevestiging</li>
            </ol>
        </div>
    </div>
    <div class="row justify-content-md-center mt-4">
      <div class="col-md-8 heading">
          <h2>Overzicht van {{$user['email']}}</h2>
      </div>
    </div>
    <div class="row justify-content-md-center mb-4">
    <div class="col-md-8 heading">
      <h4>Kaartnummer:  {{$user['card']}}</h4>
    </div>
  </div>
    <div class="my-4">
    <table class="table mt-2 table-striped col-md-12">
        <thead>
          <tr>
            <th scope="col">Product Code</th>
            <th scope="col">Naam</th>
            <th scope="col">Specificaties</th>
            <th scope="col">Eind datum</th>
          </tr>
        </thead>
        <tbody>
        @if (isset($cart)) 
          @foreach ($cart as $key => $item)
          <tr>
            <td>{{$item['id_toestel']}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['specificaties']}}</td>
            <td>{{ date('d-m-Y', strtotime($date)) }}</td>
          </tr>
          @endforeach
        @endif
        </tbody>
    </table> 
  </div>

</div>
<div class="container fixed-bottom">
<div class="row pb-4 pt-1 footer">
      <div class="col-md-6"><a href="{{ url('/user') }}" class="btn btn-black col-sm-4 float-left" role="button">terug</a></div>
      <div class="col-md-6"><a href="{{ url('/overzicht/set') }}" class="btn btn-black col-sm-4 float-right" role="button">bevestig</a></div>
    </div>
</div>
@endsection