@extends('layouts.app')
@section('content')
@if (count($referals) > 0)

  <?php
  $colcount=count($referals);
  $i=0;
  ?>
  <h3>Wyniki badań <a class="btn btn-primary float-right" href="/referals/create">Dodaj wynik badań</a></h3>
  <hr class="hr-primary">
    @foreach ($referals as $referal)
      @if ($i % 4 == 0)
        <div class="row mb-3">
      @endif
      <div class="col-3">
      <div class="card mb-3 tmp-card" style="">
        <img class="card-img-top" height="250" width="250" src="storage/referals/1/{{$referal->photo}}" alt="{{$referal->name}}">
      <div class="card-body">
      <h5 class="card-title">{{$referal->name}}</h5>
      <hr>
      <h6 class="card-subtitle mb-2 text-muted"></h6>
      <p class="card-text">
        {{$referal->description}}
        <hr>
          <br>
          <a href="#" class="float-left btn btn-primary">Edytuj</a>
          <a href="#" class="float-right btn btn-danger">Usuń</a>

      </p>
      <div class="text-right tmp-btn">
      </div>
      </div>
      </div>
      </div>
      @if ($i % 4 == 3)
      </div>
      @endif
      <?php
      $i++;
      ?>
    @endforeach
    @if (($i - 1) % 4 !=0)
    </div>
    @endif
@else
  <p>Brak wyników</p>
  <a href="/referals/create" class="btn btn-primary">Dodaj skierowanie</a>
@endif
@endsection
