@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Edytuj specjalizację</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a></div>
              <div class="card-body">
                {!!Form::open(['action' => ['SpecializationsController@update', $specialization->id], 'method' => 'POST'])!!}
                {{Form::bsText('name', $specialization->name, ['placeholder' => 'Podaj nazwę specjalizacji', 'label' => 'Specjalizacja'])}}
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Zapisz', ['class' => 'btn btn-primary'])}}
                {!!Form::close()!!}
              </div>
          </div>
      </div>
  </div>
@endsection
