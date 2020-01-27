@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Edytuj badanie</h3><a class='float-right btn btn-outline-info' href='/dashboard'>Powrót</a></div>
              <div class="card-body">
                {!!Form::open(['action' => ['ExaminationsController@update', $examination->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                {{Form::bsText('name', $examination->name, ['placeholder' => 'Podaj nazwę', 'label' => 'Nazwa'])}}
                <div>
                  {{Form::label('doctor', 'Lekarz')}}
                  {{Form::select('doctor', $doctors, $examination->doctor_id , ['label' => 'Wybierz lekarza', 'placeholder' => 'Wybierz lekarza', 'class' => 'form-control'])}}
                </div>
                {{Form::bsTextArea('description', $examination->description, ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}
                <br>
                <div class="card">
                  <div class="card-body">
                    <div class="center-card-image">
                        <img src="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}" alt="{{$examination->photo}}">
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
@endsection
