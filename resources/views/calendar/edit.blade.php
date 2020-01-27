{{-- @extends('layouts.app')
@section('content')
  <form action="{{action('EventsController@update', $event->id)}}" method="POST">
    {{ csrf_field() }}
    <div class="jumbotron">
      <h1>Aktualizuj wydarzenie</h1>
      <hr>
      <input type="hidden" name="_method" value="UPDATE"/>
      <div class="form-group">
        <label>Nazwa wydarzenia</label>
        <input type="text" name="title" value="{{$event->title}}">
      </div>
    </div>

  </form>
@endsection --}}

@extends('layouts.app')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3 style="display:inline">Edytuj wydarzenie</h3><a class='float-right btn btn-outline-info' href='/displaydata'>Powrót</a></div>
              <div class="card-body">
                {!!Form::open(['action' => ['EventsController@update', $event->id], 'method' => 'POST'])!!}
                {{Form::bsText('name', $event->title, ['placeholder' => 'Podaj nazwę wydarzenia', 'label' => 'title'])}}
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="">Wybierz datę początkową</label>
                      <input type="datetime-local" class="form-control" value="{{$event->convertStartDate()}}" class="date" name="start_date" placeholder="Wybierz datę początkową"/>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="">Wybierz datę końcową</label>
                      <input type="datetime-local" class="form-control" value={{$event->convertEndDate()}} class="date" name="end_date" placeholder="Wybierz datę końcową" />
                    </div>
                  </div>
                </div>
                {{Form::bsTextArea('about', $event->description, ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Zapisz', ['class' => 'btn btn-primary'])}}
                {!!Form::close()!!}
              </div>
          </div>
      </div>
  </div>
@endsection
