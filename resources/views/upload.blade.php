@extends('layout')

@section('content')

    <h3>Please upload your csv file with next fields:</h3>
    <ul>
        <li>id</li>
        <li>driver_id</li>
        <li>pickup</li>
        <li>dropoff</li>
    </ul>
    <br>
    <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <br>
                <input type="file" name="csv_file">
                <button type="submit">Import CSV</button>
            </form>
@endsection

