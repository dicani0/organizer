@extends('layouts.app')
@section('content')
  @php
    $i=0;
  @endphp
  <div class="row">
    <div class="col-12">
      <a href="/specializations/create" style="width: 100%; color: black;" class="float-right btn btn-outline-primary mb-4">Dodaj specjalizację</a>
    </div>
  </div>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Nazwa specjalizacji</th>
        <th>Edytuj/Usuń</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($specializations as $specialization)
        @php
          $i++;
        @endphp
        <tr>
          <th style="width: 5%;" scope="row">{{$i}}</th>
          <td>{{$specialization->name}}</td>
          <td style="width: 10%;">
            <div class="btn-group" role="group">
              <a class="btn btn-outline-primary mr-2" href="/specializations/{{$specialization->id}}/edit">Edytuj</a>
              {!!Form::open(['action' => ['SpecializationsController@destroy', $specialization->id], 'method' => 'POST', 'onsubmit' => 'return confirm("Na pewno? Usunięcie specjalizacji może spowodować usunięcie lekarza do niej przypisanego.")'])!!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Usuń', ['class' => 'btn btn-outline-danger'])}}
              {!!Form::close()!!}
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
