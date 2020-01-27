@extends('layouts.app')
@section('content')
  <div class="card mx-auto" style="width: 40rem;">
    <div class="card-body">
      <div class="card-title">
        {{$examination->name}}
        <hr>
      </div>
      <div class="card-img">
        <img class="test-popup-link card-img" src="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}"
          href="/storage/examinations/{{$subuser_id}}/{{$examination->photo}}" alt="{{$examination->name}}">
      </div>
      <hr>
      <div class="card-text">
        {{$examination->doctor->FullName}}
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.test-popup-link').magnificPopup({type:'image'});
    });
  </script>

@endsection
