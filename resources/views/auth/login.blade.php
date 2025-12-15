@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="p-5 border rounded shadow mt-5 mb-5 my-form" style="width:400px;">
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <h3 class="text-center mb-4 mt-3 fw-bold">Login</h3>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control my-field" id="email" name="email" required>
                    @error('email')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required style="background-color:#F2EDE6;">
                    @error('password')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                @error('credentials')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror

                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('register.page') }}">Create account?</a>
                    <a href="{{ route('register.page') }}">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
            </form>
        </div>
    </div>
@endsection