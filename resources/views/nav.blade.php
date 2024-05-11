<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('import') }}">{{ __('Import') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('export.csv') }}">{{ __('Export') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="clear-data" href="{{ route('clear') }}">{{ __('Clear data') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('trips.index') }}">{{ __('Trips') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('drivers.index') }}">{{ __('Drivers') }}</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('clear-data').addEventListener('click', function (event) {
            event.preventDefault();

            if (confirm("Are you sure?")) {
                window.location.href = this.href;
            }
        });
    });
</script>
