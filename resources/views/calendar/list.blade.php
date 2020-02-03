@extends('layouts.app')
@section('content')
    <table class="table table-striped table-bordered table-hover">
      <thead class="thead">
        <tr class="warning">
          <th>ID</th>
          <th>Nazwa</th>
          <th>Data początkowa</th>
          <th>Data końcowa</th>
          <th>Dodatkowe informacje</th>
          <th>Edytuj</th>
          <th>Usuń</th>
        </tr>
      </thead>
      <tbody>
        <?php $counter = 1; ?>
        @foreach ($events as $event)
          <tr>
            <td>{{$counter}}</td>
            <?php $counter++; ?>
            <td>{{$event->title}}</td>
            <td>{{$event->start_date}}</td>
            <td>{{$event->end_date}}</td>
            <td>{{$event->description}}</td>
            {{-- <td><a href="{{action('EventsController@edit', $event['id'])}}" class="float-left btn btn-primary"><i style="color: white;" class="fas fa-edit"></i></a></td> --}}
            <td><a href="{{route('events.edit', $event->id)}}" class="float-left btn btn-primary"><i style="color: white;" class="far fa-edit"></i></a></td>
            <td>{!!Form::open(['action' => ['EventsController@destroy', $event->id], 'method' => 'POST', 'class' => 'btn btn-danger btn-sm', 'onsubmit' => 'return confirm("Na pewno?")'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{ Form::button('<i style="color: white;" class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) }}
            {{-- {{Form::submit('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm'])}} --}}
            {!!Form::close()!!}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

@endsection
