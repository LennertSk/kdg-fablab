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
    <h2>Item toevoegen</h2>
        <table class="table table-striped col-md-12">
            <thead>
            <tr>
                <th scope="col">Naam</th>
                <th scope="col">Code ( moet uniek zijn )</th>
                <th scope="col">Specificaties</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <form class='col-md-12' method='POST' action='{{ url("dashboard/addItem/add") }}'>
                @csrf
                <td><input type="text" class="form-control" id="name" aria-describedby="name" name="name"></td>
                <td><input type="text" class="form-control" id="id_toestel" aria-describedby="id_toestel" name="id_toestel"></td>
                <td><input type="text" class="form-control" id="specs" aria-describedby="specs" name="specs"></td>
                <td><button type="submit" class="btn admin-btn btn-primary">{{ __('Opslaan') }}</button></td>
                <input type="text" name='available' value='1' hidden>
            </form>
            </tr>
            </tbody>
        </table>    
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
    </div>
</div>

@endsection

       