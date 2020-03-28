@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <ol class="progressbar">
                <li class="is-complete" data-step="&#10004;">Items Selecteren</li>
                <li class="is-active" data-step="2">Datum Kiezen</li>
                <li data-step="3">Registreren</li>
                <li class="progressbar__last" data-step="4">Bevestiging</li>
            </ol>
        </div>
    </div>
    <div class="row justify-content-md-center my-4">
      <div class="col-md-8 heading">
          <h2>Hoelang wilt u deze items ontlenen?</h2>
      </div>
    </div>
    <div class="row my-4">
        <form class='col-md-12' method='POST' action='{{ url("datum/set") }}'>
          @csrf
            <div class="form-group row justify-content-md-center">
              <div class="col-sm-4">
                <input type="date" class="form-control center-me" id="date" aria-describedby="date" name="date">
              </div>
              <button type="submit" class="btn btn-black col-sm-4">{{ __('Bevestig') }}</button>
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
          </tr>
        </thead>
        <tbody>
        @if (isset($cart)) 
          @foreach ($cart as $key => $item)
          <tr>
            <td>{{$item['id_toestel']}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['specificaties']}}</td>
          </tr>
          @endforeach
        @endif
        </tbody>
      </table>    
    </div>
</div>
<div class="container fixed-bottom">
<div class="row pb-4 pt-1 footer">
      <div class="col-md-6"><a href="{{ url('/ontlenen') }}" class="btn btn-black col-sm-4 float-left" role="button">terug</a></div>
    </div>
</div>
@endsection


