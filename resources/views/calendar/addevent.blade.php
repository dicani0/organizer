@extends('layouts.app')
@section('content')
   <div class="card">
     <div class="card-header">
       Dodaj wydarzenie
     </div>
     <div class="card-body">
       <form class="" action="{{action('EventsController@store')}}" method="post">
         {{ csrf_field() }}
         <div class="row">
           <div class="col-10">
             <div class="form-group">
               <label for="">Nazwa wydarzenia</label>
               <input type="text" class="form-control" name="title" placeholder="Podaj nazwę wydarzenia"/>
             </div>
           </div>
           <div class="col">
             <div class="form-group">
               <label for="">Wybierz kolor</label>
               <input type="color" class="form-control" name="color" placeholder="Wybierz kolor"/>
             </div>
           </div>
         </div>



        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="">Wybierz datę początkową</label>
              <input type="datetime-local" class="form-control" class="date" name="start_date" placeholder="Wybierz datę początkową"/>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="">Wybierz datę końcową</label>
              <input type="datetime-local" class="form-control" class="date" name="end_date" placeholder="Wybierz datę końcową" />
            </div>
          </div>


        </div>

        <br>
        <input type="submit" name="submit" class="btn btn-primary" value="Dodaj"/>
      </form>
     </div>
   </div>
@endsection
