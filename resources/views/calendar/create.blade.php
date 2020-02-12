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
           <div class="col-9">
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
              <input type="text" name="start_date" value="" placeholder="Podaj datę początkową" class="form-control datepicker">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="">Wybierz datę końcową</label>
              <input type="text" name="end_date" placeholder="Podaj datę końcową" value="" class="form-control datepicker">
            </div>
          </div>
        </div>
        <label for="">Dodatkowe informacje</label>
        <textarea name="description" class="form-control" placeholder="Podaj dodatkowe informację" rows="5" cols="2"></textarea>
        <br>
        <input type="submit" name="submit" class="btn btn-primary" value="Dodaj"/>
      </form>
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
