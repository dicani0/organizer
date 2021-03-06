@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Dodaj skierowanie do listy</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a></div>
              <div class="card-body">
                {!!Form::open(['action' => 'ReferalsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                {{Form::bsText('name', '', ['placeholder' => 'Podaj tytuł', 'label' => 'Tytuł'])}}
                <div>
                  {{Form::label('doctor', 'Lekarz wystawiający skierowanie')}}
                  {{Form::select('doctor_id_from', $doctors, null, ['placeholder' => 'Wybierz lekarza, który wystawił skierowanie', 'class' => 'form-control js-select'])}}
                </div>
                <br>
                <div>
                  {{Form::label('doctor', 'Lekarz, do którego jest skierowanie')}}
                  {{Form::select('doctor_id_to', $doctors, null, ['placeholder' => 'Wybierz lekarza, do którego zostałeś/aś skierowany/a', 'class' => 'form-control js-select'])}}
                </div>
                <br>
                {{Form::bsTextArea('description', '', ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}
                {{Form::file('photo')}}
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
