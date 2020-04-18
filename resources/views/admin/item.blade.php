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
    <h2>Item Details.</h2>
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
            <form class='col-md-12' method='POST' action='{{ url("dashboard/item/set") }}'>
                @csrf

                @if ($item['is_available'] === 0)
                <input type="text" name='id' value='{{$item["id"]}}' hidden>
                <td><input type="text" class="form-control" id="name" aria-describedby="name" name="name" value='{{$item["name"]}}' disabled></td>
                <td><input type="text" class="form-control" id="code" aria-describedby="code" name="code" value='{{$item["id_toestel"]}}' disabled></td>
                <td><input type="text" class="form-control" id="specs" aria-describedby="specs" name="specs" value='{{$item["specificaties"]}}' disabled></td>

                <td>Item is momenteel ontleend door <br> <a href="{{ url('/dashboard/gebruiker/' . $info[0]['id_ontlener']) }}">{{$info[0]['email_ontlener']}}</a></td>
                <input type="text" name='available' value='1' hidden>
                @else

                <input type="text" name='id' value='{{$item["id"]}}' hidden>
                <td><input type="text" class="form-control" id="name" aria-describedby="name" name="name" value='{{$item["name"]}}'></td>
                <td><input type="text" class="form-control" id="code" aria-describedby="code" name="code" value='{{$item["id_toestel"]}}'></td>
                <td><input type="text" class="form-control" id="specs" aria-describedby="specs" name="specs" value='{{$item["specificaties"]}}'></td>
                
                <td>
                <select class="form-control" id="available" name='available' >
                    <option value="1">Beschikbaar</option>
                    @if ($item['is_available'] === 2)
                    <option value="2" selected>Niet beschikbaar (onderhoud)</option>
                    @else
                    <option value="2">Niet beschikbaar (onderhoud)</option>
                    @endif
                </select>
                </td>
                <input type="text" name='available' value='1' hidden>

                <td><button type="submit" class="btn admin-btn btn-primary">{{ __('Opslaan') }}</button></td>
                @endif

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

    <div class="row mt-4">
    <h2>Laatste Opmerkingen.</h2>
        <table class="table table-striped col-md-12">
            <tbody>
                @if (isset($info)) 
                    @foreach ($info as $key => $item)
                    <tr>
                        <td>{{$item['opmerkingen']}}</td>
                        <td><a href="{{ url('/dashboard/gebruiker/' . $item['id_ontlener']) }}">{{$item['email_ontlener']}}</a></td>
                        <td>{{$item['start_datum']}} - {{$item['terug_datum']}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>    
    </div>


</div>

@endsection

       