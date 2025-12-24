@props(['address'])

@extends('layouts.app')

@section('title', 'Add new address')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="p-5 border rounded shadow mt-4 mb-5 my-form" style="width:650px;">
            <form action="{{ route('address.update', $address) }}" method="POST">
                @csrf
                @method('PUT')

                <h3 class="text-center mb-4 mt-3 fw-bold">Update Address</h3>

                <div class="mb-3">
                    <label for="receiver_fullname" class="form-label fw-bold">Fullname</label>
                    @error('receiver_fullname')
                        <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                    @enderror
                    <input type="text" class="form-control my-field" id="receiver_fullname" name="receiver_fullname" value="{{ old('receiver_fullname', $address->receiver_fullname) }}" required">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">Phone Number</label>
                    @error('phone')
                        <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                    @enderror
                    <input type="text" class="form-control my-field" id="phone" name="phone" value="{{ old('phone', $address->phone) }}" required">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">Address</label>
                    @error('address')
                        <span class="invalid-feedback d-block ms-4">{{ $message }}</span>
                    @enderror
                    <input type="text" class="form-control my-field" id="address" name="address" value="{{ old('address', $address->address) }}" required">
                </div>

                <div class="d-flex flex-column justify-content-between align-items-center">
                    <a href="{{ url()->previous() }}" class="btn btn-danger w-100 mt-2 mb-2">Back</a>
                    <button type="submit" class="btn btn-success w-100">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection