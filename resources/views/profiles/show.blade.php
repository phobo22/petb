@props(['profile'])

@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="container mt-5 mb-5" style="width:900px">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="card">
            <div class="card-body shadow my-form">
                <form class="mt-3">
                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">First name</label>
                        <input type="text" class="form-control my-field ms-4" style="width:800px;" name="firstname" value="{{ $profile->firstname }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Last name</label>
                        <input type="text" class="form-control my-field ms-4" style="width:800px;" name="lastname" value="{{ $profile->lastname }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Gender</label>
                        <input class="ms-5" type="radio" name="gender" value="1" {{ $profile->gender === 1 ? 'checked' : '' }} disabled> Male
                        <input class="ms-3" type="radio" name="gender" value="0" {{ $profile->gender === 0 ? 'checked' : '' }} disabled> Female
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold ms-3">Date of birth</label>
                        <input class="ms-3 my-field" type="date" name="dob" value="{{ $profile->dob }}" readonly>
                    </div>

                    <div class="d-flex justify-content-evenly">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">EDIT</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection