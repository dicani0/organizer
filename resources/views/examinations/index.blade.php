@extends('layouts.app')
@section('content')
<h3>Wyniki badań <a class="btn btn-primary float-right" href="/examinations/create">Dodaj wynik badań</a></h3>
<hr class="hr-primary">
@if (count($examinations) > 0)

  <?php
  $colcount=count($examinations);
  $i=0;
  ?>



  <div class="col">
    <input type="text" id="myFilter" class="form-control" onkeyup="filterResults()" placeholder="Szukaj...">
  </div>

  <div class="d-flex p-2 bd-highlight" id="collection" style="flex-wrap: wrap; align-items: stretch;">
    @foreach ($examinations as $examination)
      <div class="card col-3">
        {{-- <img class="card-img-top" height="250" width="250" src="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}" alt="{{$examination->name}}"></img> --}}
        <div class="card-body">
          <h5 class="card-title">{{$examination->name}}</h5>
          <hr>
          <p class="card-text">
            <b>Lekarz: </b> <br> {{$examination->doctor->FullName}}
            <br>
            <b>Data badania</b>: <br> {{$examination->date}}
            <br>
            <?php
              $ext = explode(".", $examination->photo);
              $ext = end($ext);
             ?>
            <b>Format załącznika</b>: {{$ext}}
            <br>

            <hr>
            <a href="/examinations/{{$examination->id}}/" class="btn btn-success btn-lg" style="display: block;">Szczegóły</a>
            <hr>
            <a href="/examinations/{{$examination->id}}/edit" class="float-left btn btn-primary">Edytuj</a>
            {!!Form::open(['action' => ['ExaminationsController@destroy', $examination->id], 'method' => 'POST', 'class' => 'btn btn-danger btn-sm float-right', 'onsubmit' => 'return confirm("Na pewno?")'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm'])}}
            {!!Form::close()!!}
          </p>
        </div>
      </div>
    @endforeach
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
