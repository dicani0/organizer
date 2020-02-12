@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Dodaj lekarza do listy</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a></div>
              <div class="card-body">
                {!!Form::open(['action' => 'DoctorsController@store', 'method' => 'POST'])!!}
                {{Form::bsText('name', '', ['placeholder' => 'Podaj imię', 'label' => 'Imię'])}}
                {{Form::bsText('surname', '', ['placeholder' => 'Podaj nazwisko', 'label' => 'Nazwisko'])}}
                {{Form::bsText('address', '', ['placeholder' => 'Podaj adres', 'label' => 'Adres'])}}
                {{Form::bsText('phone', '', ['placeholder' => 'Podaj numer telefonu', 'label' => 'Numer telefonu'])}}
                {{Form::bsText('website', '', ['placeholder' => 'Podaj adres strony internetowej lekarza lub kliniki', 'label' => 'Strona internetowa'])}}
                {{Form::bsTextArea('about', '', ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}
                <div>
                  {{Form::select('specialization', $specializations, null, ['placeholder' => 'Wybierz specjalizację', 'class' => 'form-control js-select'])}}
                  <a href="/specializations/create" class="btn btn-info form-control">Dodaj specjalizację</a>
                </div>
                <br>
                {{Form::submit('Dodaj')}}
                {!!Form::close()!!}
              </div>
          </div>
      </div>
  </div>

  <script type="text/javascript">
  $(document).ready(function() {
    $('.js-select').select2();
  });
  </script>
@endsection
