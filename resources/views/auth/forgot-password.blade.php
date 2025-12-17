@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="p-5 border rounded shadow mt-4 mb-5 my-form" style="width:500px;">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Enter your email</label>
                    <input type="email" class="form-control my-field" name="email" id="email" required>
                </div>

                @error('email')
                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                @enderror

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">
                        Send Reset Link
                    </button>
                </div>

                @if (session('status'))
                    <div class="alert alert-success mt-4">
                        {{ session('status') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection