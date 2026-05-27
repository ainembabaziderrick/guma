@extends('layouts.master')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">My Documents</h3>
        <div class="box-tools">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadModal">
                <i class="fa fa-upload"></i> Upload Document
            </button>
        </div>
    </div>
    <div class="box-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Document Title</th>
                    <th>Type</th>
                    <th>Uploaded On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $key => $doc)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $doc->title }}</td>
                    <td>{{ ucfirst($doc->type) }}</td>
                    <td>{{ $doc->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="btn btn-xs btn-info">
                            <i class="fa fa-eye"></i> View
                        </a>
                        <a href="{{ route('applicant.documents.download', $doc->id) }}" class="btn btn-xs btn-success">
                            <i class="fa fa-download"></i> Download
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No documents uploaded yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Upload Modal --}}
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('applicant.documents.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Document</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Document Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="passport">Passport</option>
                            <option value="cv">CV</option>
                            <option value="police_clearance">Interpol</option>
                            <option value="medical_exam">Medical</option>
                            <option value="visa">Visa</option>
                            <option value="certificate">Certificate</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" name="document" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection