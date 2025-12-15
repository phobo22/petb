@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="p-5 border rounded shadow mt-4 mb-5 my-form" style="width:510px;">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">
                
                <label>New password</label>
                <input type="password" name="password" class="form-control" required>
                <label class="mt-3">Confirm password</label>
                <input type="password" name="password_confirmation" class="form-control" required>

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