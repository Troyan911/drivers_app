<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Driver's time app</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css"/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

    <script>
        $(document).ready(function () {
            $('#data-table').DataTable();
        });

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('clear-data').addEventListener('click', function (event) {
                event.preventDefault();

                if (confirm("Are you sure?")) {
                    window.location.href = this.href;
                }
            });
        });
    </script>

</head>
<body class="antialiased">
<div id="wrapper">

    @include('nav')
    @yield('content')

</div>
</body>
</html>
