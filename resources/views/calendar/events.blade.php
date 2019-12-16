@extends('layouts.app')
@section('content')
       <div class="jumbotron">
         <div class="row">
           <a href="/addeventurl" class="btn btn-success">Dodaj wydarzenie</a>
           <a href="/editeventurl" class="btn btn-success">Edytuj wydarzenie</a>
           <a href="/deleteeventurl" class="btn btn-danger">Usuń wydarzenie</a>
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
       </div>
             <div class="card-body">
               <script type="text/javascript">
                 $('#calendar').fullCalendar({!! $calendar->getOptionsJson() !!});
               </script>
             </div>
           </div>
         </div>
       </div>

@endsection
