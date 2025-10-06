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
            <form id="loginForm">
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

<script>
    const apiBase = '/api';

    document.getElementById('registerForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const form = e.target;
        const data = {
            name: form.name.value,
            email: form.email.value,
            password: form.password.value,
            password_confirmation: form.password_confirmation.value
        };

        try {
            const res = await fetch(`${apiBase}/register`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const json = await res.json();
            document.getElementById('registerMessage').innerHTML =
                res.ok
                    ? `<div class="alert alert-success">${json.message}</div>`
                    : `<div class="alert alert-danger">${json.message || Object.values(json.errors).join('<br>')}</div>`;
        } catch (err) {
            console.error(err);
        }
    });

    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const form = e.target;
        const data = {
            email: form.email.value,
            password: form.password.value
        };

        try {
            const res = await fetch(`${apiBase}/login`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const json = await res.json();
            document.getElementById('loginMessage').innerHTML =
                res.ok
                    ? `<div class="alert alert-success">Login successful. Token: <code>${json.token}</code></div>`
                    : `<div class="alert alert-danger">${json.message}</div>`;
        } catch (err) {
            console.error(err);
        }
    });
</script>
</body>
</html>
