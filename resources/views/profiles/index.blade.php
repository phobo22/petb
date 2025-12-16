@props(['page'])

@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container mt-5 mb-5" style="width:900px">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="card">
            <ul>
                <li>
                    <a href="{{ route('profile.show') }}" class="nav-link">View Profile</a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="nav-link">Edit Profile</a>
                </li>
                <li>
                    <a href="{{ route('password.change') }}" class="nav-link">Change Password</a>
                </li>
            </ul>
        </div>
    </div>
@endsection