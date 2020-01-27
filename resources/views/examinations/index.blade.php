@extends('layouts.app')
@section('content')
@if (count($examinations) > 0)

  <?php
  $colcount=count($examinations);
  $i=0;
  ?>
  <h3>Wyniki badań <a class="btn btn-primary float-right" href="/examinations/create">Dodaj wynik badań</a></h3>
  <input type="text" id="myFilter" class="form-control" onkeyup="filterResults()" placeholder="Szukaj...">
  <hr class="hr-primary">
    @foreach ($examinations as $examination)
      @if ($i % 4 == 0)
        <div class="row mb-3">
      @endif
      <div class="col-3">
      <div class="card mb-3 tmp-card" style="">
        <img class="card-img-top" height="250" width="250" src="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}" alt="{{$examination->name}}">
      <div class="card-body">
      <h5 class="card-title">{{$examination->name}}</h5>
      <hr>
      <h6 class="card-subtitle mb-2 text-muted"></h6>
      <p class="card-text">
        {{$examination->description}}
        <hr>
          <br>
          <a href="/examinations/{{$examination->id}}/" class="btn btn-success btn-lg" style="display: block;">Szczegóły</a>
          <hr>
          <a href="/examinations/{{$examination->id}}/edit" class="float-left btn btn-primary">Edytuj</a>
          {!!Form::open(['action' => ['ExaminationsController@destroy', $examination->id], 'method' => 'POST', 'class' => 'btn btn-danger btn-sm float-right', 'onsubmit' => 'return confirm("Na pewno?")'])!!}
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
  <p>Brak wyników</p>
@endif
<script>
function myFunction() {
  var input, filter, cards, cardContainer, h5, title, i;
  input = document.getElementById("myFilter");
  filter = input.value.toUpperCase();
  cardContainer = document.getElementById("myItems");
  cards = cardContainer.getElementsByClassName("card");
  for (i = 0; i < cards.length; i++) {
      title = cards[i].querySelector(".card-body h5.card-title");
      if (title.innerText.toUpperCase().indexOf(filter) > -1) {
          cards[i].style.display = "";
      } else {
          cards[i].style.display = "none";
      }
  }
}
</script>
@endsection
