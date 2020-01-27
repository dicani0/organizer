@extends('layouts.app')
@section('content')
  <div class="card mx-auto" style="width: 40rem;">
    <div class="card-body">
      <div class="card-title">
        {{$referal->name}}
      </div>
      <div class="card-img">
        <a class="popup" href="/storage/referals/{{$subuser_id}}/{{$referal->photo}}">
          <img class="card-img" src="/storage/referals/{{$subuser_id}}/{{$referal->photo}}" alt="{{$referal->name}}">
        </a>
      </div>
      <hr>
      <div class="card-text">
        {{$referal->doctorfrom->getFullNameAttribute()}}
        <hr>
        {{$referal->doctorto->getFullNameAttribute()}}
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.popup').magnificPopup({
        type:'image'
      });
    });
  </script>

@endsection
