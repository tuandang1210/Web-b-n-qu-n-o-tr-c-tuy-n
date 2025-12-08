<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
    <style>
        body { padding: 20px; background-color: #f8f9fa; }
        .nav-link.active { font-weight: bold; }
        .card { margin-bottom: 20px; }
    </style>
</head>

<body>
    <h1 class="mb-4">Welcome, Admin</h1>
    <a href="{{ route('logout') }}" class="btn btn-danger mb-3">Logout</a>

    <!-- Navigation -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}"
               href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}"
               href="{{ route('admin.products') }}">Products</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
               href="{{ route('admin.users') }}">Users</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}"
               href="{{ route('admin.orders') }}">Orders</a>
        </li>
    </ul>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
