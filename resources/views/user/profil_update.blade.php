@extends('layouts.master')

@section('title')
Profile Updated Successfully
@endsection

@section('breadcrumb')
    @parent
    <li class="active"></li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-check"></i> {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-times"></i> {{ session('error') }}
                    </div>
                @endif

                <div class="alert alert-info alert-dismissible" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-check"></i> Profile updated successfully
                </div>
                <div class="text-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-lg btn-primary">
                        <i class="fa fa-home"></i> Return to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection