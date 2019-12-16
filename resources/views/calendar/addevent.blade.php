@extends('layouts.app')
@section('content')
   <div class="card">
     <div class="card-header">
       Dodaj wydarzenie
     </div>
     <div class="card-body">
       <form class="" action="{{action('EventsController@store')}}" method="post">
         

      <label for="">Nazwa wydarzenia</label>
      <input type="text" class="form-control" name="title" placeholder="Podaj nazwę wydarzenia"/>
      <label for="">Wybierz kolor</label>
      <input type="color" class="form-control" name="color" placeholder="Wybierz kolor"/>
      <label for="">Wybierz datę początkową</label>
      <input type="date" class="form-control" class="date" name="start_date"/>
      <label for="">Wybierz datę końcową</label>
      <input type="date" class="form-control" class="date" name="end_date" />
      <br>
      <input type="submit" name="submit" class="btn btn-primary" value="Dodaj"/>
      </form>
     </div>
   </div>
@endsection
