@extends('layouts.app')
@section('content')
  <div class="row">
      <div class="col">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Dodaj lekarza do listy</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a></div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <div class="card-header mb-2">
                      <h4>Dane osobowe</h4>
                    </div>
                      {!!Form::open(['action' => 'DoctorsController@store', 'method' => 'POST'])!!}
                      {{Form::bsText('name', '', ['placeholder' => 'Podaj imię', 'label' => 'Imię'])}}
                      {{Form::bsText('surname', '', ['placeholder' => 'Podaj nazwisko', 'label' => 'Nazwisko'])}}
                      {{Form::bsText('address', '', ['placeholder' => 'Podaj adres', 'label' => 'Adres'])}}
                      {{Form::bsText('phone', '', ['placeholder' => 'Podaj numer telefonu', 'label' => 'Numer telefonu'])}}
                      {{Form::bsText('website', '', ['placeholder' => 'Podaj adres strony internetowej lekarza lub kliniki', 'label' => 'Strona internetowa'])}}
                  </div>
                  <div class="col-6">
                    <div class="card-header mb-2">
                      <h4>Dane dodatkowe</h4>
                    </div>
                    {{Form::bsTextArea('about', '', ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}
                    <div>
                      {{Form::select('specialization', $specializations, null, ['placeholder' => 'Wybierz specjalizację', 'class' => 'form-control js-select'])}}
                      <br>
                      <br>
                      <div class="row">
                        <div class="col-6">
                          <a href="/specializations" class="btn btn-success form-control">Zarządzaj specjalizacjami</a>
                        </div>
                          <div class="col-6">
                        <a href="/specializations/create" style="color: white;" class="btn btn-info form-control">Dodaj specjalizację</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <br>
                {{Form::submit('Dodaj', ['class' => 'btn btn-primary'])}}
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
