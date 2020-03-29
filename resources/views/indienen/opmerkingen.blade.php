@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <ol class="progressbar">
                <li class="is-complete" data-step="1">Item Indienen</li>
                <li class="is-active progressbar__last" data-step="2">Beoordeling</li>
            </ol>
        </div>
    </div>
    <div class="row justify-content-md-center my-4">
      <div class="col-md-8 heading">
          <h2>Hoe was uw ervaring met dit item?
          </h2>
      </div>
    </div>
    <table class="table mt-2 table-striped col-md-12">
        <thead>
          <tr>
            <th scope="col">Product Code</th>
            <th scope="col" >Ontleent door</th>
            <th scope="col">Eind datum</th>
          </tr>
        </thead>
        <tbody>
        @if (isset($item)) 
          <tr>
            <td>{{$item['id_toestel']}}</td>
            <td>{{$item['email_ontlener']}}</td>
            <td>{{ date('d-m-Y', strtotime($item['eind_datum'])) }}</td>
          </tr>
        @endif
        </tbody>
    </table> 
    <div class="row my-4">
      <form class='col-md-12 mt-3' method='POST' action='{{ url("indienen/final") }}'>
        <input type="text" name='id_toestel' value="{{$item['id_toestel']}}" hidden>
        @csrf
          <div class="form-group row justify-content-md-center mb-4">
            <div class="form-check form-check-inline col-sm-3">
                <input class="form-check-input" type="radio" name='status' id="inline-radio1" value="0" >
                <label class="form-check-label" for="inline-radio1">Dit toestel is defect.</label>
            </div>
            <div class="form-check form-check-inline col-sm-3">
                <input class="form-check-input" type="radio" name='status' id="inline-radio2" value="1" required>
                <label class="form-check-label" for="inline-radio2">Dit toestel is beschadigd.</label>
            </div>
            <div class="form-check form-check-inline col-sm-3">
                <input class="form-check-input" type="radio" name='status' id="inline-radio3" value="2">
                <label class="form-check-label" for="inline-radio3">Dit toestel werkt perfect.</label>
            </div>
          </div>
          <div class="form-group row justify-content-md-center mt-2">
          <textarea class="form-control" id="opmerkingen" rows="3" name='opmerkingen' placeholder='Opmerkingen'></textarea>
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
      <div class="col-md-6"><a href="{{ url('/indienen') }}" class="btn btn-black col-sm-4 float-left" role="button">terug</a></div>
      <div class="col-md-6"><button type="submit" class="btn btn-black  col-sm-4 float-right">{{ __('Volgende') }}</button></div></form>
    
</div>

@endsection


