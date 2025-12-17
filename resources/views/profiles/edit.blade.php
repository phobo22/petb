@props(['profile'])

@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="container mt-5 mb-5" style="width:900px">
        <!-- @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif -->
        <div class="card">
            <div class="card-body shadow my-form">
                <form class="mt-3" method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">First name</label>
                        @error('firstname')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control my-field ms-4" style="width:800px;" name="firstname" value="{{ old('firstname', $profile->firstname) }}">
                    </div>
                    

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Last name</label>
                        @error('lastname')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control my-field ms-4" style="width:800px;" name="lastname" value="{{ old('lastname', $profile->lastname) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Gender</label>
                        @error('gender')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input class="ms-5" type="radio" name="gender" value="1" {{ $profile->gender == true ? 'checked' : '' }}> Male
                        <input class="ms-3" type="radio" name="gender" value="0" {{ $profile->gender == false ? 'checked' : '' }}> Female
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Date of birth</label>
                        @error('dob')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input class="ms-3 my-field" type="date" name="dob" value="{{ old('dob', $profile->dob) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Phone Number</label>
                        @error('phone')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control my-field ms-4" style="width:800px;" name="phone" value="{{ old('phone', $profile->phone) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Address</label>
                        @error('address')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control my-field ms-4" style="width:800px;" name="address" value="{{ old('address', $profile->address) }}">
                    </div>

                    <div class="d-flex justify-content-evenly">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-dark">Discard</a>
                        <button type="submit" class="btn btn-outline-primary">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection