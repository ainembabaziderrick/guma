@extends('layouts.master')
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Available Jobs</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Country</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->country }}</td>
                    <td>{{ $job->salary }}</td>
                    <td><a href="#" class="btn btn-sm btn-primary">Apply</a></td>
                </tr>
                @empty
                <tr><td colspan="4">No jobs available</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection