<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Layout</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>

<section id="header">
    <h2>Welcome, {{ $user->username }}!</h2>
    <div>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('customer.homepage') ? 'active' : '' }}"
                   href="{{ route('customer.homepage') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('customer.shop') ? 'active' : '' }}"
                   href="{{ route('customer.shop') }}">Shop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('customer.contact') ? 'active' : '' }}"
                   href="{{ route('customer.contact') }}">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('customer.orders') ? 'active' : '' }}"
                   href="{{ route('customer.orders') }}">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.cart') }}">
                    <i class="bi bi-bag-fill"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a>
            </li>
        </ul>
    </div>
    <div class="mobile">
        <i class="bi bi-justify" id="bar"></i>
    </div>
</section>

<section>
    @yield('customer')
</section>

<section class="newsletter">
    <div class="letter">
        <h4>Sign up for Newsletter</h4>
        <p>Get Email updates about our letter shop special offers</p>
    </div>
    <div class="form">
        <div class="input-group mb-3">
            <input type="text" id="emailInput" class="form-control" placeholder="Your Email Address">
            <button class="btn btn-outline-secondary" type="button">Sign Up</button>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('/js/script.js') }}" defer></script>

</body>
</html>
