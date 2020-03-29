@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <ol class="progressbar">
                <li class="is-active" data-step="1">Item Indienen</li>
                <li  class="progressbar__last" data-step="2">Beoordeling</li>
            </ol>
        </div>
    </div>
    <div class="row justify-content-md-center my-4">
      <div class="col-md-8 heading">
          <h2>Vul de code in van het item dat u wilt indienen.
          </h2>
      </div>
    </div>
    <div class="row my-4">
      <form class='col-md-12' method='POST' action='{{ url("indienen/set") }}'>
        @csrf
          <div class="form-group row justify-content-md-center">
            <div class="col-sm-6">
                <input type="text" class="form-control" id="id_toestel" aria-describedby="id_toestel" name="id_toestel" placeholder="XX-YYY-00">
            </div>
            <button type="submit" class="btn btn-black col-sm-2">{{ __('Volgende') }}</button>
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
</div>
<div class="container fixed-bottom">
<div class="row pb-4 pt-1 footer">
      <div class="col-md-6"><a href="{{ url('/home') }}" class="btn btn-black col-sm-4 float-left" role="button">terug</a></div>
    </div>
</div>

@endsection


