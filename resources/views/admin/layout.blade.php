<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #212529;
            transition: all 0.3s;
        }

        .sidebar.collapsed {
            margin-left: -240px;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 12px 20px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #343a40;
            color: #fff;
        }

        .content {
            width: 100%;
            padding: 20px;
        }

        .topbar {
            height: 56px;
            background: #fff;
            border-bottom: 1px solid #dee2e6;
        }

        .toggle-btn {
            border: none;
            background: none;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>

<div class="d-flex">

    <div id="sidebar" class="sidebar">
        <h4 class="text-white text-center py-3">Admin Panel</h4>

        <ul class="nav flex-column">
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

            <li class="nav-item mt-3">
                <a href="{{ route('logout') }}" class="nav-link text-danger">Logout</a>
            </li>
        </ul>
    </div>

    <div class="flex-grow-1">

        <div class="topbar d-flex align-items-center px-3">
            <button class="toggle-btn me-3" onclick="toggleSidebar()">☰</button>
            <h5 class="mb-0">Welcome, Admin</h5>
        </div>

        <div class="content">
            @yield('content')
        </div>

    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('collapsed');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
