@extends('layouts.app')
@section('content')
  <div class="card mx-auto" style="width: 40rem;">
    <div class="card-body">
      <div class="card-title">
        {{$prescription->name}}
        <p class="float-right"><a class="btn btn-outline-primary" href="/prescriptions">Powrót</a></p>
        <a href="/prescription/{{$prescription->id}}/edit" class="float-right btn btn-outline-success">Edytuj</a>
      </div>
      <div class="card-img">
        <a class="popup" href="/storage/prescriptions/{{$subuser_id}}/{{$prescription->photo}}">
          <img class="card-img" src="/storage/prescriptions/{{$subuser_id}}/{{$prescription->photo}}" alt="{{$prescription->name}}">
        </a>
        <a class="btn btn-outline-success" download href="/storage/prescriptions/{{$subuser_id}}/{{$prescription->photo}}">Pobierz  <i style="color: #38c172;" class="fas fa-download"></i></a>
      </div>
      <hr>
      <div class="card-text">
        Lekarz: <b>{{$prescription->doctor->getFullNameAttribute()}}</b>
        <hr>
        Lekarstwa i dawkowanie: <br><i>{{$prescription->medicine}}</i>

      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.popup').magnificPopup({
        type:'image'
      });
    });
  </script>

@endsection
