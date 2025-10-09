@extends('layouts.base')

@section('content')
<div class="py-4">
    <h2 class="mb-4">Login / Register</h2>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    {{-- Login Form --}}
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
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                {{-- Register Form --}}
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
        </div>
    </div>

</div>
@endsection
