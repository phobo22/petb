@props(['addrInfo'])

@extends('layouts.app')

@section('title', 'Shipping Address Information')

@section('content')
<div class="container py-5" style="max-width: 1000px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📦 Shipping Addresses</h2>

        <a href="{{ route('address.create') }}"
           class="btn btn-primary">
            + Add New Address
        </a>
    </div>

    @if ($addrInfo->isEmpty())
        <div class="alert alert-info">
            You have not added any shipping address yet.
        </div>
    @else
        <div class="card">
            <div class="card-body p-0">
                <table class="table align-middle mb-0">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Fullname</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($addrInfo as $index => $address)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $address->receiver_fullname }}</td>
                                <td>{{ $address->phone }}</td>
                                <td>{{ $address->address }}</td>

                                <td class="text-end">
                                    <a href="{{ route('address.edit', $address) }}"
                                       class="btn btn-outline-secondary btn-sm">
                                        Update
                                    </a>

                                    <form method="POST"
                                          action="{{ route('address.destroy', $address) }}"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
