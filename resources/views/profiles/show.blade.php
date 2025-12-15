@props(['page', 'profile'])

@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="container mt-5 mb-5" style="width:900px">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-body shadow my-form">
                <form class="mt-3" method="{{ $page === 'edit' ? 'POST' : 'GET' }}" action="{{ route('profile.update', $profile) }}">
                    @csrf
                    @if ($page === 'edit')
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">First name</label>
                        @error('firstname')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control my-field ms-4" style="width:800px;" name="firstname" value="{{ old('firstname', $profile->firstname) }}" {{ $page === 'show' ? 'readonly' : '' }}>
                    </div>
                    

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Last name</label>
                        @error('lastname')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control my-field ms-4" style="width:800px;" name="lastname" value="{{ old('lastname', $profile->lastname) }}" {{ $page === 'show' ? 'readonly' : '' }}>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Gender</label>
                        @error('gender')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input class="ms-5" type="radio" name="gender" value="1" {{ $profile->gender == true ? 'checked' : '' }} {{ $page === 'show' ? 'disabled' : '' }}> Male
                        <input class="ms-3" type="radio" name="gender" value="0" {{ $profile->gender == false ? 'checked' : '' }} {{ $page === 'show' ? 'disabled' : '' }}> Female
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Date of birth</label>
                        @error('dob')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input class="ms-3 my-field" type="date" name="dob" value="{{ old('dob', $profile->dob) }}" {{ $page === 'show' ? 'readonly' : '' }}>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Phone Number</label>
                        @error('phone')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control my-field ms-4" style="width:800px;" name="phone" value="{{ old('phone', $profile->phone) }}" {{ $page === 'show' ? 'readonly' : '' }}>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Address</label>
                        @error('address')
                            <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control my-field ms-4" style="width:800px;" name="address" value="{{ old('address', $profile->address) }}" {{ $page === 'show' ? 'readonly' : '' }}>
                    </div>

                    <div class="d-flex justify-content-evenly">
                        @if ($page === 'edit')
                            <a href="{{ route('profile.show', $profile) }}" class="btn btn-outline-dark">Discard</a>
                            <button type="submit" class="btn btn-outline-primary">UPDATE</button>
                        @else
                            <a href="{{ route('profile.edit', $profile) }}" class="btn btn-outline-primary">UPDATE</a>
                        @endif
                    </div>
                </form>

                
            </div>
        </div>
    </div>
@endsection