@extends('layout')

@section('content')
    <table id="data-table" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">driver id</th>
            <th scope="col">minutes</th>
        </tr>
        </thead>
        <tbody>

        @foreach($drivers as $driver)
            <tr>
                <td><a href="{{route('drivers.show', $driver->driver_id)}}">{{$driver->driver_id}}</a></td>
                <td>{{$driver->minutes}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
