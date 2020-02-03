@extends('layouts.app')
@section('content')
<h3>Zalecenia lekarskie <a class="btn btn-primary float-right" href="/recommendations/create">Dodaj zalecenie</a></h3>
<hr class="hr-primary">
@if (count($recommendations) > 0)

  <?php
  $colcount=count($recommendations);
  $i=0;
  ?>



  <div class="col">
    <input type="text" id="myFilter" class="form-control" onkeyup="filterResults()" placeholder="Szukaj...">
  </div>

  <div class="d-flex p-2 bd-highlight" id="collection" style="flex-wrap: wrap; align-items: stretch;">
    @foreach ($recommendations as $recommendation)
      <div class="card col-3">
        <img class="card-img-top" height="250" width="250" src="/storage/recommendations/{{$subuser_id}}/{{$recommendation->photo}}" alt="{{$recommendation->name}}">
        <div class="card-body">
          <h5 class="card-title">{{$recommendation->name}}</h5>
          <hr>
          <p class="card-text">
            <b>Lekarz: </b> <br> {{$recommendation->doctor->FullName}}
            <br>
            <hr>
            <a href="/recommendations/{{$recommendation->id}}/" class="btn btn-success btn-lg" style="display: block;">Szczegóły</a>
            <hr>
            <a href="/recommendations/{{$recommendation->id}}/edit" class="float-left btn btn-primary">Edytuj</a>
            {!!Form::open(['action' => ['RecommendationsController@destroy', $recommendation->id], 'method' => 'POST', 'class' => 'btn btn-danger btn-sm float-right', 'onsubmit' => 'return confirm("Na pewno?")'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm'])}}
            {!!Form::close()!!}
          </p>
        </div>
      </div>
    @endforeach
@else
  <p>Brak wyników</p>
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
        description = cards[i].querySelector(".card-body p.card-text")
        if (title.innerText.toUpperCase().indexOf(filter) > -1 || description.innerText.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}
</script>
@endsection
