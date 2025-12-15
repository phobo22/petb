@extends('layouts.app')

@section('title', 'Register Account')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="p-5 border rounded shadow mt-4 mb-5 my-form" style="width:650px;">
            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                <h3 class="text-center mb-4 mt-3 fw-bold">Register</h3>

                <div class="mb-3">
                    <label for="firstname" class="form-label fw-bold">Firstname</label>
                    <input type="text" class="form-control my-field" id="firstname" name="firstname" required">
                    @error('firstname')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label fw-bold">Lastname</label>
                    <input type="text" class="form-control my-field" id="lastname" name="lastname" required">
                    @error('lastname')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control my-field" id="email" name="email" required">
                    @error('email')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control my-field" name="password" id="password" required style="background-color:#F2EDE6;">
                    @error('password')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Register</button>
            </form>
        </div>
    </div>
@endsection