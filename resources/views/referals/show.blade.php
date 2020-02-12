@extends('layouts.app')
@section('content')
  <div class="card mx-auto" style="width: 40rem;">
    <div class="card-body">
      <div class="card-title">
        {{$referal->name}}
        <p class="float-right"><a class="btn btn-outline-primary" href="/referals">Powrót</a></p>
        <a href="/referals/{{$referal->id}}/edit" class="float-right btn btn-outline-success">Edytuj</a>
        <hr>
      </div>
      <div class="card-img">
        <a class="popup" href="/storage/referals/{{$subuser_id}}/{{$referal->photo}}">
          <img class="card-img" src="/storage/referals/{{$subuser_id}}/{{$referal->photo}}" alt="{{$referal->name}}">
        </a>
        <hr>
        <a class="btn btn-outline-success" download href="/storage/examinations/{{$subuser_id}}/{{$referal->photo}}">Pobierz  <i style="color: #38c172;" class="fas fa-download"></i></a>
      </div>
      <hr>
      <div class="card-text">
        Lekarz wystawiający skierowanie <b>{{$referal->doctorfrom->getFullNameAttribute()}}</b><br>
        Lekarz, do którego zostało wystawione skierowanie <b>{{$referal->doctorto->getFullNameAttribute()}}</b>
        @if ($referal->description!="")
        <hr>
        Dodatkowe informacje:<br>
        <i>
          {{$referal->description}}
        </i>
        @endif
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
