@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="p-5 border rounded shadow mt-4 mb-5 my-form" style="width:500px;">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <label>Enter your email</label>
                <input type="email" name="email" class="form-control" required>

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