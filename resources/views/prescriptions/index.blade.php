@extends('layouts.app')
@section('content')
@if (count($prescriptions) > 0)

  <?php
  $colcount=count($prescriptions);
  $i=0;
  ?>
  <h3>Wyniki badań <a class="btn btn-primary float-right" href="/prescriptions/create">Dodaj wynik badań</a></h3>
  <hr class="hr-primary">
    @foreach ($prescriptions as $prescription)
      @if ($i % 4 == 0)
        <div class="row mb-3">
      @endif
      <div class="col-3">
      <div class="card mb-3 tmp-card" style="">
        <img class="card-img-top" height="250" width="250" src="/storage/prescriptions/{{$subuser_id}}/{{$prescription->photo}}" alt="{{$prescription->name}}">
      <div class="card-body">
      <h5 class="card-title">{{$prescription->name}}</h5>
      <hr>
      <h6 class="card-subtitle mb-2 text-muted"></h6>
      <p class="card-text">
        {{$prescription->description}}
        <hr>
          <br>
          <a href="/prescriptions/{{$prescription->id}}/" class="btn btn-success btn-lg" style="display: block;">Szczegóły</a>
          <hr>
          <a href="/prescriptions/{{$prescription->id}}/edit" class="float-left btn btn-primary">Edytuj</a>
          {!!Form::open(['action' => ['PrescriptionsController@destroy', $prescription->id], 'method' => 'POST', 'class' => 'btn btn-danger btn-sm float-right', 'onsubmit' => 'return confirm("Na pewno?")'])!!}
          {{Form::hidden('_method', 'DELETE')}}
          {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm'])}}
          {!!Form::close()!!}

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
  <div class="row">
    <div class="col-4">
        <p>Brak wyników</p>
    </div>
    <div class="col-8">
      <a class="btn btn-primary float-right" href="/prescriptions/create">Dodaj wynik badań</a>
    </div>

  </div>

@endif
@endsection
