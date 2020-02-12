@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Edytuj badanie</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a></div>
              <div class="card-body">
                {!!Form::open(['action' => ['ReferalsController@update', $recommendation->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                {{Form::bsText('name', $recommendation->name, ['placeholder' => 'Podaj nazwę', 'label' => 'Nazwa'])}}
                <div>
                  {{Form::label('doctor_from', 'Lekarz wystawiający skierowanie')}}
                  {{Form::select('doctor_from', $doctors, $recommendation->doctor_id_from , ['label' => 'Wybierz lekarza', 'placeholder' => 'Wybierz lekarza', 'class' => 'form-control js-select'])}}
                </div>
                <div>
                  {{Form::label('doctor_to', 'Lekarz, do którego zostało wystawione skierowanie')}}
                  {{Form::select('doctor_to', $doctors, $recommendation->doctor_id_to , ['label' => 'Wybierz lekarza', 'placeholder' => 'Wybierz lekarza', 'class' => 'form-control js-select'])}}
                </div>
                {{Form::bsTextArea('description', $recommendation->description, ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}
                <br>
                <div class="card">
                  <div class="card-body">
                    <div class="center-card-image">
                        <img src="/storage/recommendations/{{$subuser_id}}/{{$recommendation->photo}}" alt="{{$recommendation->photo}}">
                    </div>
                  </div>
                </div>

                <br>
                {{Form::hidden('subuser_id', $subuser_id)}}
                {{Form::hidden('_method', 'PUT')}}
                {{Form::file('photo')}}
                <br>
                <br>
                {{Form::submit('Zapisz', ['class' => 'btn btn-primary'])}}
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
