@extends('layout')

@section('content')
    <table id="data-table" class="table table-striped table-bordered" style="width:80%">
        <thead>
        <tr>
            <th scope="col">driver id</th>
            <th scope="col">minutes</th>
        </tr>
        </thead>
        <tbody>

        @foreach($data as $driver_id => $minutes)
            <tr>
                <td><a href="{{route('drivers.show', $driver_id)}}">{{$driver_id}}</a></td>
                <td>{{$minutes}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
