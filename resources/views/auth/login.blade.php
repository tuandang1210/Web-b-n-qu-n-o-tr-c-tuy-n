<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h3 class="text-center mb-4">Login</h3>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label for="loginuser" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="loginuser" value="{{ old('username') }}" required>
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="loginPassword" required minlength="6">
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 text-center">
          Don't have an account? <a href="{{ route('register') }}">Register</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
