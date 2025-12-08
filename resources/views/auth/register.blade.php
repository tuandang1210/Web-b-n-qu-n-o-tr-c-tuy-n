<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <h3 class="text-center mb-4">Register</h3>

      @if(session('success'))
          <div class="alert alert-success">{!! session('success') !!}</div>
      @endif

      @if($errors->any())
          <div class="alert alert-danger">
              {{ $errors->first() }}
          </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }} 
        <div class="mb-3">
          <label for="regUsername" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" id="regUsername" value="{{ old('username') }}" required>
        </div>
        <div class="mb-3">
          <label for="regPassword" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="regPassword" required minlength="6">
        </div>
        <div class="mb-3">
          <label for="confirmPassword" class="form-label">Confirm Password</label>
          <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" required minlength="6">
        </div>
        <button type="submit" class="btn btn-success w-100">Register</button>
      </form>

      <p class="mt-3 text-center">
        Already have an account? <a href="{{ route('login') }}">Login</a>
      </p>
    </div>
  </div>
</div>
</body>
</html>
