@extends('layouts.app')
@section('content')

  <h3>Wyniki badań <a class="btn btn-primary float-right" href="/examinations/create">Dodaj wynik badań</a></h3>

  <hr class="hr-primary">

  @if (count($examinations) > 0)
    <?php
      $colcount=count($examinations);
      $i=0;
    ?>
    <div class="row">
      <div class="col">
        <input type="text" id="myFilter" class="form-control mb-3" onkeyup="filterResults()" placeholder="Szukaj...">
      </div>
    </div>
    <div class="row" id="collection" style="margin-top: 15px;">
      @foreach ($examinations as $examination)
        <div class="col-3 mb-3">
          <div class="card">
            {{-- <img class="card-img-top" height="250" width="250" src="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}" alt="{{$examination->name}}"></img> --}}
            <div class="card-body">
              <h5 class="card-title" style="height: 50px;">{{$examination->name}}</h5>
              <hr>
              <div class="card-text">
                <b>Lekarz: </b> <br> {{$examination->doctor->FullName}}
                <br>
                <b>Data badania</b>: <br> {{$examination->date}}
                <br>
                <?php
                  $ext = explode(".", $examination->photo);
                  $ext = end($ext);
                ?>
                <b>Format załącznika</b>: {{$ext}}
              </div>
            </div>
            <div class="card-footer">
              <a href="/examinations/{{$examination->id}}/" class="btn btn-success btn-lg" style="display: block;">Szczegóły <i style="color: white;" class="fas fa-info-circle"></i></a>
              <hr>
              <a href="/examinations/{{$examination->id}}/edit" class="float-left btn btn-primary">Edytuj <i style="color:white;" class="fas fa-edit"></i></a>
              {!!Form::open(['action' => ['ExaminationsController@destroy', $examination->id], 'method' => 'POST', 'class' => 'float-right', 'onsubmit' => 'return confirm("Na pewno?")'])!!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::button('Usuń <i style="color: white;" class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'float right btn btn-danger btn'])}}
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <h6>Brak wyników</h6>
  @endif
  <script>
    function filterResults() {
      var input, filter, cards, cardContainer, h5, title, description, i;
      input = document.getElementById("myFilter");
      filter = input.value.toUpperCase();
      cardContainer = document.getElementById("collection");
      cards = cardContainer.getElementsByClassName("card");
      for (i = 0; i < cards.length; i++) {
        title = cards[i].querySelector(".card-body h5.card-title");
        description = cards[i].querySelector(".card-body .card-text")
        if (title.innerText.toUpperCase().indexOf(filter) > -1 || description.innerText.toUpperCase().indexOf(filter) > -1) {
          cards[i].parentElement.style.display = "";
        } else {
          cards[i].parentElement.style.display = "none";
        }
      }
    }
  </script>
@endsection
