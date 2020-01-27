@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Dodaj receptę</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a></div>
                <div class="card-body">
                  {!!Form::open(['action' => 'PrescriptionsController@store' ,'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                  {{Form::bsText('name', '', ['placeholder' => 'Podaj nazwę badania', 'label' => 'Nazwa badania'])}}
                  <div class='form-group'>
                    {{Form::label('doctor', 'Lekarz')}}
                    {{Form::select('doctor_id', $doctors, null, ['label' => 'Lekarz', 'placeholder' => 'Wybierz lekarza', 'class' => 'form-control'])}}
                  </div>
                  {{Form::bsTextArea('medicine', '', ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}
                  {{Form::file('photo')}}
                  {{Form::submit('Wyślij',['class' => 'btn btn-primary'])}}
                  {!!Form::close()!!}
                </div>
              </div>
            </div>
  </div>
@endsection
