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
    <form id="import" action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <br>
        <ul class="import-item-list">
            <li class="import-controls">
                <input id="file" type="file" name="csv_file">
            </li>
            <li class="import-controls">
                <button id="submit" type="submit">Import CSV</button>
            </li>
        </ul>
    </form>
@endsection

