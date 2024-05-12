@extends('layout')

@section('content')

    <table id="data-table" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">trip id</th>
            <th scope="col">driver id</th>
            <th scope="col">pickup</th>
            <th scope="col">dropoff</th>
            <th scope="col">minutes</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trips as $trip)
            <tr>
                <td><a href="{{route('trips.show', $trip)}}">{{$trip->id}}</a></td>
                <td><a href="{{route('drivers.show', $trip->driver_id)}}">{{$trip->driver_id}}</a></td>
                <td>{{$trip->pickup}}</td>
                <td>{{$trip->dropoff}}</td>
                <td>{{$trip->minutes}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
