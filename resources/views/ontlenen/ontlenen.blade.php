@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <ol class="progressbar">
                <li class="is-active" data-step="1">Items Selecteren</li>
                <li data-step="2">Datum Kiezen</li>
                <li data-step="3">Registreren</li>
                <li class="progressbar__last" data-step="4">Bevestiging</li>
            </ol>
        </div>
    </div>
    <div class="row justify-content-md-center my-4">
      <div class="col-md-8 heading">
          <h2>Vul de code in van het item dat u wilt ontlenen.
              <a class="btn btn-sm btn-circle btn-outline-info" data-toggle="collapse" href="#collapseInfo" role="button" aria-expanded="false" aria-controls="collapseExample">
                  ?
              </a>
          </h2>
      </div>
    </div>
    <div class="row my-4">
      <form class='col-md-12' method='POST' action='{{ url("ontlenen/add") }}'>
        @csrf
          <div class="form-group row justify-content-md-center">
            <div class="col-sm-6">
                <input type="text" class="form-control" id="id_toestel" aria-describedby="id_toestel" name="id_toestel" placeholder="XX-YYY-00">
            </div>
            <button type="submit" class="btn btn-black col-sm-2">{{ __('Toevoegen') }}</button>
          </div>
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
      </form>
    </div>
    <div class="row">
      <table class="table mt-2 table-striped col-md-12">
        <thead>
          <tr>
            <th scope="col">Product Code</th>
            <th scope="col">Naam</th>
            <th scope="col">Specificaties</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
        @if (isset($cart)) 
          @foreach ($cart as $key => $item)
          <tr>
            <td>{{$item['id_toestel']}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['specificaties']}}</td>
            <td><a href="{{ url('/ontlenen/' . $key) }}" class="btn btn-danger" role="button">Delete</a></td>
          </tr>
          @endforeach
        @endif
        </tbody>
      </table>    
    </div>
</div>
<div class="container fixed-bottom">
<div class="row pb-4 pt-1 footer">
      <div class="col-md-6"><button type="submit" class="btn btn-black col-sm-4 float-left">Terug</button></div>
      <div class="col-md-6"><button type="submit" class="btn btn-black col-sm-4 float-right">Volgende</button></div>
    </div>
</div>

@endsection


