@extends('layouts.master')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">My Profile</h3>
    </div>
    <div class="box-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('applicant.profile.update') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" 
                    value="{{ old('name', $candidate->name ?? $user->name) }}" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                <small class="text-muted">Email comes from your account and can’t be changed here</small>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" 
                    value="{{ old('phone', $candidate->phone ?? '') }}" required>
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Region</label>
                        <input type="text" name="region" class="form-control" 
                            value="{{ old('region', $candidate->region ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>District</label>
                        <input type="text" name="district" class="form-control" 
                            value="{{ old('district', $candidate->district ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>County</label>
                        <input type="text" name="county" class="form-control" 
                            value="{{ old('county', $candidate->county ?? '') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Subcounty</label>
                        <input type="text" name="subcounty" class="form-control" 
                            value="{{ old('subcounty', $candidate->subcounty ?? '') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Village</label>
                        <input type="text" name="village" class="form-control" 
                            value="{{ old('village', $candidate->village ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob" class="form-control" 
                    value="{{ old('dob', $candidate->dob ?? '') }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Info</button>
        </form>
    </div>
</div>
@endsection