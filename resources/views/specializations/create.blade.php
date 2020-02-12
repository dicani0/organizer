@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Dodaj specjalizację</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a><a class="float-right btn btn-outline-primary" href="/specializations">Zarządzaj specjalizacjami</a></div>
              <div class="card-body">
                {!!Form::open(['action' => 'SpecializationsController@store', 'method' => 'POST'])!!}
                {{Form::bsText('name', '', ['placeholder' => 'Podaj nazwę specjalizacji', 'label' => 'Specjalizacja'])}}
                {{Form::submit('Dodaj', ['class' => 'btn btn-primary'])}}
                {!!Form::close()!!}
              </div>
          </div>
      </div>
  </div>
@endsection
