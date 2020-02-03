@extends('layouts.app')
@section('content')

         <div class="row">
           <div class="col-10">
             <a href="/events/create" class="btn btn-success">Dodaj wydarzenie</a>
             <a href="/events/list" class="btn btn-primary">Lista wydarzeń</a>
           </div>

           <input type="checkbox" class="changeView" checked style="height: 20px;" class="float-right" name="showAll" value="showAll">Pokaż dla wszystkich<br>
           {{-- <a href="/deleteeventurl" class="btn btn-danger">Usuń wydarzenie</a> --}}
         </div>
         <div class="row">
           <div class="col-md-12 col-md-offset-2">
             <div class="panel panel-default">
               <div class="panel-heading" style="background: #2e6da4; color: white;">
                 Terminarz
               </div>
               <div id="calendar"></div>
             </div>
           </div>
         </div>

             <div class="card-body">
               <script type="text/javascript">
                 $('#calendar').fullCalendar({!! $calendar->getOptionsJson() !!});

                 $('.changeView').on('change', function(e){
                   window.location.href = "/events";
                 })

               </script>
             </div>
           </div>
         </div>
       </div>

@endsection
