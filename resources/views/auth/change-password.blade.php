@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="p-5 border rounded shadow mt-4 mb-5 my-form" style="width:510px;">
            <form method="POST" action="{{ route('password.save') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="current_password" class="form-label fw-bold">Old Password</label>
                    <input type="password" class="form-control my-field" id="current_password" name="current_password" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">New Password</label>
                    <input type="password" class="form-control my-field" id="password" name="password" required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                    <input type="password" class="form-control my-field" id="password_confirmation" name="password_confirmation" required>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">{{ $errors->all()[0] }}</div>
                @endif

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection