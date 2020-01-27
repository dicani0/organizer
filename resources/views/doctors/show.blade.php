@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 style="display:inline">Lekarze</h3><span class="float-right"><a href="/doctors/create" class="btn btn-outline-primary">Dodaj lekarza</a></span></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($doctors)>0)
                      <table class="table table-striped">
                        <tr>
                          <th>Imię</th>
                          <th>Nazwisko</th>
                          <th>Adres</th>
                          <th>Telefon</th>
                          <th>Strona internetowa</th>
                          <th>Dodatkowe informacje</th>
                          <th>Specjalizacja</th>
                          <th></th>
                          <th></th>
                        </tr>
                        @foreach ($doctors as $doctor)
                          <tr>
                            <td>{{$doctor->name}}</td>
                            <td>{{$doctor->surname}}</td>
                            <td>{{$doctor->address}}</td>
                            <td>{{$doctor->phone}}</td>
                            <td>{{$doctor->website}}</td>
                            <td>{{$doctor->about}}</td>
                            <td>{{$doctor->specialization->name}}</td>
                            <td>
                              <div class="btn-group">
                                <a class='btn btn-info btn-sm float-right' href="/doctors/{{$doctor->id}}/edit">Edytuj</a>

                                  {!!Form::open(['action' => ['DoctorsController@destroy', $doctor->id], 'method' => 'POST', 'class' => 'float-left', 'onsubmit' => 'return confirm("Na pewno?")'])!!}
                                  {{Form::hidden('_method', 'DELETE')}}
                                  {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm'])}}
                                  {!!Form::close()!!}

                              </div>
                            </td>

                          </tr>
                        @endforeach
                      </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
