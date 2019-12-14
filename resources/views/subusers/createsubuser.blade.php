@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Dodaj podopiecznego</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a></div>
              <div class="card-body">
                {!!Form::open(['action' => 'SubusersController@store', 'method' => 'POST'])!!}
                {{Form::bsText('name', '', ['placeholder' => 'Podaj imię', 'label' => 'Imię'])}}
                {{Form::bsText('subname', '', ['placeholder' => 'Podaj nazwisko', 'label' => 'Nazwisko'])}}
                {{Form::bsText('address', '', ['placeholder' => 'Podaj adres', 'label' => 'Adres'])}}
                {{Form::bsText('phone', '', ['placeholder' => 'Podaj numer telefonu', 'label' => 'Numer telefonu'])}}
                {{Form::bsTextArea('about', '', ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}
                {{Form::submit('Dodaj')}}
                {!!Form::close()!!}
              </div>
          </div>
      </div>
  </div>
@endsection
