@extends('layouts.app')
@section('content')
  <div class="card mx-auto" style="width: 40rem;">
    <div class="card-body">
      <div class="card-title">
        {{$recommendation->name}}
        <p class="float-right"><a class="btn btn-outline-primary" href="/recommendations">Powrót</a></p>
        <a href="/recommendation/{{$recommendation->id}}/edit" class="float-right btn btn-outline-success">Edytuj</a>
      </div>
      <div class="card-img">
        <a class="popup" href="/storage/recommendations/{{$subuser_id}}/{{$recommendation->photo}}">
          <img class="card-img" src="/storage/recommendations/{{$subuser_id}}/{{$recommendation->photo}}" alt="{{$recommendation->name}}">
        </a>
      </div>
      <hr>
      <div class="card-text">
        Lekarz: <b>{{$recommendation->doctor->getFullNameAttribute()}}</b><br>
        Dodatkowe informacje: <br><i>{{$recommendation->description}}</i>

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
