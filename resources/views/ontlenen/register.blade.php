@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <ol class="progressbar">
                <li class="is-complete" data-step="&#10004;">Items Selecteren</li>
                <li class="is-complete" data-step="2">Datum Kiezen</li>
                <li class="is-active" data-step="3">Registreren</li>
                <li class="progressbar__last" data-step="4">Bevestiging</li>
            </ol>
        </div>
    </div>
    <div class="row justify-content-md-center my-4">
      <div class="col-md-8 heading">
          <h2>Gelieve uw gegevens in te vullen.</h2>
      </div>
    </div>
    <form  method='POST' action='{{ url("user/set") }}'>
    <div class="my-4">
          @csrf
            <div class="form-group row justify-content-md-center col-md-12 mt-4">
              <div class="col-sm-5">
                <label for="email">KdG E-mailadres</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" name="email" >
              </div>
              <div class="col-sm-5">
                <label for="studentenNummer">Studentennummer / Personeelsnummer</label>
                <input type="textfield" class="form-control" id="studentenNummer" aria-describedby="studentenNummer" name="studentenNummer" >
              </div>
            </div>
            <div class="row">
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
    </div>
    

</div>
<div class="container fixed-bottom">
<div class="row pb-4 pt-1 footer">
      <div class="col-md-6"><a href="{{ url('/ontlenen') }}" class="btn btn-black col-sm-4 float-left" role="button">terug</a></div>
      <div class="col-md-6"><button type="submit" class="btn btn-black col-sm-4 float-right">{{ __('Bevestig') }}</button></div></form>
    </div>
</div>
@endsection