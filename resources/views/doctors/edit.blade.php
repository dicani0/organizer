@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Edytuj lekarza</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a></div>
              <div class="card-body">
                {!!Form::open(['action' => ['DoctorsController@update', $doctor->id], 'method' => 'POST'])!!}
                {{Form::bsText('name', $doctor->name, ['placeholder' => 'Podaj imię', 'label' => 'Imię'])}}
                {{Form::bsText('surname', $doctor->surname, ['placeholder' => 'Podaj nazwisko', 'label' => 'Nazwisko'])}}
                {{Form::bsText('address', $doctor->address, ['placeholder' => 'Podaj adres', 'label' => 'Adres'])}}
                {{Form::bsText('phone', $doctor->phone, ['placeholder' => 'Podaj numer telefonu', 'label' => 'Numer telefonu'])}}
                {{Form::bsText('website', $doctor->website, ['placeholder' => 'Podaj adres strony internetowej lekarza lub kliniki', 'label' => 'Strona internetowa'])}}
                {{Form::bsTextArea('about', $doctor->about, ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}

                <div>
                  {{Form::select('specialization', $specializations, $doctor->spec_id , ['placeholder' => 'Wybierz specjalizację', 'class' => 'form-control'])}}
                </div>
                <br>
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Zapisz', ['class' => 'btn btn-primary'])}}
                {!!Form::close()!!}
              </div>
          </div>
      </div>
  </div>
@endsection
