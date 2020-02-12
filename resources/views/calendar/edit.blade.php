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
                <div class="row">
                  <div class="col-9">
                    {{Form::bsText('title', $event->title, ['class' => 'form-control', 'placeholder' => 'Podaj nazwę wydarzenia', 'label' => 'Nazwa wydarzenia'])}}
                  </div>
                  <div class="col-3">
                    <div class="">
                      <label for="">Wybierz kolor</label>
                      <input type="color" class="form-control" name="color" placeholder="Wybierz kolor"/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="">Wybierz datę początkową</label>
                      <input type="text" name="start_date" value="{{$event->start_date}}" placeholder="Podaj datę początkową" class="form-control datepicker">
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="">Wybierz datę końcową</label>
                      <input type="text" name="end_date" placeholder="Podaj datę końcową" value="{{$event->end_date}}" class="form-control datepicker">
                    </div>
                  </div>
                </div>
                {{Form::bsTextArea('description', $event->description, ['placeholder' => 'Podaj dodatkowe informacje', 'label' => 'Dodatkowe informacje'])}}
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Zapisz', ['class' => 'btn btn-primary'])}}
                {!!Form::close()!!}
              </div>
          </div>
      </div>
  </div>
  <script type="text/javascript">
  $(function () {
    $('.datepicker').datetimepicker({
      format: 'YYYY-MM-DD HH:mm',
      stepping: 10,
      icons: {
        time:'far fa-clock'
      }
    });
  });
  </script>
@endsection
