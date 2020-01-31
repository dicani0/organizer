@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 style="display:inline">Podopieczni</h3><span class="float-right"><a href="/subusers/create" class="btn btn-outline-primary">Dodaj podopiecznego</a></span></div>

                <div class="card-body">

                  <div id="alert-box">

                  </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($subusers)>0)
                      <table class="table table-striped">
                        <tr>
                          <th>Imię</th>
                          <th>Nazwisko</th>
                          <th>Adres</th>
                          <th>Numer telefonu</th>
                          <th>Dodatkowe informacje</th>
                          <th></th>
                        </tr>
                        @foreach ($subusers as $subuser)
                          <tr>
                            <td>{{$subuser->name}}</td>
                            <td>{{$subuser->subname}}</td>
                            <td>{{$subuser->address}}</td>
                            <td>{{$subuser->phone}}</td>
                            <td>{{$subuser->about}}</td>
                            <td>
                              <div class="btn btn-group">


                            <a data-id='{{$subuser->id}}' class='btn btn-primary btn-sm float-right chooseSubuser' href="#"><i class="fas fa-user-check"></i></a>
                            <a class='btn btn-warning btn-sm float-right' href="/subusers/{{$subuser->id}}/edit">Edytuj</a>

                              {!!Form::open(['action' => ['SubusersController@destroy', $subuser->id], 'method' => 'POST', 'class' => 'float-left', 'onsubmit' => 'return confirm("Na pewno?")'])!!}
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
    <script type="text/javascript">
      $('.chooseSubuser').on('click', function(e){
        e.preventDefault();
        // $.get('/subuser/'+$(this).data('id'));
        $.ajax({
          method: 'GET',
          url: '/subuser/'+$(this).data('id'),
          success: function(response){
            $('#alert-box').html(
              '<div class="alert alert-success" role="alert">' +
                "Wybrano podopiecznego: "+ response +
              '</div>'
            );
            setTimeout("location.href = '/dashboard'",2500);
          }
        })
      })
    </script>
@endsection
