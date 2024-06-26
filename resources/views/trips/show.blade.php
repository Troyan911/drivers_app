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
        <tr>
            <td>{{$trip->id}}</td>
            <td>{{$trip->driver_id}}</td>
            <td>{{$trip->pickup}}</td>
            <td>{{$trip->dropoff}}</td>
            <td>{{$trip->minutes}}</td>
        </tr>
        </tbody>
    </table>
@endsection

