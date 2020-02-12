@extends('layouts.app')
@section('content')

  <h3>Skierowania <a class="btn btn-primary float-right" href="/recommendations/create">Dodaj skierowanie</a></h3>
  <hr class="hr-primary">
  @if (count($recommendations) > 0)
    <?php
      $colcount=count($recommendations);
      $i=0;
    ?>
    <div class="row">
      <div class="col">
        <input type="text" id="myFilter" class="form-control mb-3" onkeyup="filterResults()" placeholder="Szukaj...">
      </div>
    </div>
    <div class="row" id="collection" style="margin-top: 15px;">
      @foreach ($recommendations as $recommendation)
        <div class="col-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" style="height: 30px;">{{$recommendation->name}}</h5>
              <hr>
              <img class="card-img-top" height="250" width="250" src="/storage/recommendations/{{$subuser_id}}/{{$recommendation->photo}}" alt="{{$recommendation->name}}"></img>
              <hr>
              <div class="card-text">
                Lekarz:  <br>
                <b>{{$recommendation->doctor->FullName}}</b><br><br>
              </div>
            </div>
            <div class="card-footer">
              <a href="/recommendations/{{$recommendation->id}}/" class="btn btn-success btn-lg" style="display: block;">Szczegóły <i style="color: white;" class="fas fa-info-circle"></i></a>
              <hr>
              <a href="/recommendations/{{$recommendation->id}}/edit" class="float-left btn btn-primary">Edytuj <i style="color:white;" class="fas fa-edit"></i></a>
              {!!Form::open(['action' => ['RecommendationsController@destroy', $recommendation->id], 'method' => 'POST', 'class' => 'float-right', 'onsubmit' => 'return confirm("Na pewno?")'])!!}
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
