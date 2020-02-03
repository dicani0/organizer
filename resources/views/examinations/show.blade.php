@extends('layouts.app')
@section('content')
  <div class="card mx-auto" style="width: 40rem;">
    <div class="card-body">
      <div class="card-title">
        {{$examination->name}}
        <p class="float-right"><a class="btn btn-outline-primary" href="/examinations">Powrót</a></p>
        <hr>
      </div>
      <?php
        $ext = explode(".", $examination->photo);
        $ext = end($ext);
       ?>
       @if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "jfif" || $ext == "bmp" || $ext == "tif" || $ext == "tiff")
         <div class="card-img">
           <img class="test-popup-link card-img" src="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}"</img>
           <hr>
           <a class="btn btn-outline-primary" href="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}">Otwórz  <i style="color: #3490dc;" class="fas fa-external-link-alt"></i></a>
           <a class="btn btn-outline-success" download href="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}">Pobierz  <i style="color: #38c172;" class="fas fa-download"></i></a>

         </div>
         <hr>
       @endif
       @if ($ext == "pdf")
         <div class="card-img">
           <embed src="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}" type="application/pdf" width="100%" height="600px"></embed>
           <hr>
           <a class="btn btn-outline-primary" href="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}">Otwórz  <i style="color: #3490dc;" class="fas fa-external-link-alt"></i></a>
           <a class="btn btn-outline-success" download href="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}">Pobierz  <i style="color: #38c172;" class="fas fa-download"></i></a>
         </div>
         <hr>
       @endif
      <div class="card-text">
        Lekarz: <b>{{$examination->doctor->FullName}}</b><br>
        Data: <b>{{$examination->date}}</b><br>
        Dodatkowe informacje: <b>{{$examination->description}}</b>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.test-popup-link').magnificPopup({type:'image'});
    });
  </script>

@endsection
