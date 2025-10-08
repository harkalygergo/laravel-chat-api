<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat API Login/Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4">Chat API Login / Register</h2>

    {{-- Register Form --}}
    <div class="card mb-4">
        <div class="card-header">Register</div>
        <div class="card-body">
            <form id="registerForm">
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <div id="registerMessage" class="mt-3"></div>
            </form>
        </div>
    </div>

    {{-- Login Form --}}
    <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form id="loginForm" method="POST" action="{{ route('loginHandle') }}">
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-success">Login</button>
                <div id="loginMessage" class="mt-3"></div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
