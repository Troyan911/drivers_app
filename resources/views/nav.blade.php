<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('import') }}">{{ __('Import') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('export.csv') }}">{{ __('Export') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-warning" id="clear-data" href="{{ route('clear') }}">{{ __('Clear data') }}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-success" href="{{ route('trips.index') }}">{{ __('Trips') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-success" href="{{ route('drivers.index') }}">{{ __('Drivers') }}</a>
            </li>
        </ul>
</nav>
