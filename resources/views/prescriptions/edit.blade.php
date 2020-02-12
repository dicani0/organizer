@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Edytuj receptę</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a></div>
              <div class="card-body">
                {!!Form::open(['action' => ['PrescriptionsController@update', $prescription->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                {{Form::bsText('name', $prescription->name, ['placeholder' => 'Podaj nazwę', 'label' => 'Nazwa'])}}
                <div>
                  {{Form::label('doctor', 'Lekarz')}}
                  {{Form::select('doctor', $doctors, $prescription->doctor_id , ['label' => 'Wybierz lekarza', 'placeholder' => 'Wybierz lekarza', 'class' => 'form-control js-select'])}}
                </div>
                {{Form::bsTextArea('medicine', $prescription->medicine, ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}
                <br>
                <div class="card">
                  <div class="card-body">
                    <div class="center-card-image">
                        <img src="/storage/prescriptions/{{$subuser_id}}/{{$prescription->photo}}" alt="{{$prescription->photo}}">
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
