@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="p-5 border rounded shadow mt-4 mb-5 my-form" style="width:510px;">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">
                
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">New Password</label>
                    <input type="password" class="form-control my-field" name="password" id="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                    <input type="password" class="form-control my-field" name="password_confirmation" id="password_confirmation" required>
                </div>

                @error('password')
                    <div class="alert alert-danger mt-4">{{ $message }}</div>
                @enderror

                @error('email')
                    <div class="alert alert-danger mt-4">{{ $message }}</div>
                @enderror

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">
                        Reset password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection