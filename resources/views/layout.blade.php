<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>


    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: .375rem .75rem;
            margin-left: 1px;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .pagination, .navbar-nav {
            list-style-type: none;
            padding: 0;
        }

        .paginate_button, .nav-item {
            display: inline-block;
            margin-right: 5px;
        }
    </style>
</head>
<body class="antialiased">
@include('nav')

<div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    @yield('content')
</div>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "pageLength": 25
    });

    $(document).ready(function () {
        $('#data-table').DataTable();
    });
</script>
</body>
</html>
