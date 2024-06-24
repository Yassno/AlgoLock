@extends('admin.layouts.master')
@section('title', 'PeraSale-HMS')
@section('page_css')
<link href="{{ url('admin/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
@stop
@section('content')
<!-- page content -->
<main id="main" class="main">
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">App Settings</h2>
                        <div class="panel_toolbox">
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#appSettings" aria-expanded="true">
                                <i class="fa fa-chevron-up"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse show" id="appSettings">
                        <div class="card-body">
                            <form action="{{ route('app-settings-update') }}" method="post" class="form-horizontal">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="app_name" class="col-md-3 col-form-label">App Name</label>
                                    <div class="col-md-6">
                                        <input type="text" name="app_name" value="{{ $settings['app_name'] ?? '' }}" required class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="app_title" class="col-md-3 col-form-label">App Title</label>
                                    <div class="col-md-6">
                                        <input type="text" name="app_title" value="{{ $settings['app_title'] ?? '' }}" required class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="app_base_url" class="col-md-3 col-form-label">App Base Url</label>
                                    <div class="col-md-6">
                                        <input type="text" name="app_base_url" value="{{ $settings['app_base_url'] ?? '' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="address" class="col-md-3 col-form-label">Address</label>
                                    <div class="col-md-6">
                                        <input type="text" name="address" value="{{ $settings['address'] ?? '' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-md-3 col-form-label">Email</label>
                                    <div class="col-md-6">
                                        <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="currency" class="col-md-3 col-form-label">Currency</label>
                                    <div class="col-md-6">
                                        <input type="text" name="currency" value="{{ $settings['currency'] ?? '' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="phone" class="col-md-3 col-form-label">Phone</label>
                                    <div class="col-md-6">
                                        <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Audit Trail Settings</h2>
                        <div class="panel_toolbox">
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#auditSettings" aria-expanded="true">
                                <i class="fa fa-chevron-up"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse show" id="auditSettings">
                        <div class="card-body">
                            <form action="{{ route('audit-settings-update') }}" method="post" class="form-horizontal">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="audit_trail" class="col-md-3 col-form-label">Audit Record</label>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="audit_trail" id="auditTrailOn" value="1" {{ $settings['audit_trail'] == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="auditTrailOn">On</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="audit_trail" id="auditTrailOff" value="0" {{ $settings['audit_trail'] == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="auditTrailOff">Off</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-danger">Save</button>
                                    </div>
                                </div>
                            </form>

                            <form action="{{ route('remove-audit-logs') }}" method="post" class="form-horizontal">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="remove_audit_logs" class="col-md-3 col-form-label">Delete All Audit Record</label>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="notConfirm" value="0" checked>
                                            <label class="form-check-label" for="notConfirm">Not Confirm</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="confirm" value="1">
                                            <label class="form-check-label" for="confirm">Confirm</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">App Default Images</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('app_logo_change') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="mb-3 row">
                                <label for="new_logo_file" class="col-md-3 col-form-label">App Logo</label>
                                <div class="col-md-6">
                                    <img src="{{ url('logo.png') }}" alt="Logo Image" class="img-thumbnail mb-2" width="100">
                                    <input type="file" name="new_logo_file" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('app_pro_image_change') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="mb-3 row">
                                <label for="new_default_profile_picture" class="col-md-3 col-form-label">Default Profile Picture</label>
                                <div class="col-md-6">
                                    <img src="{{ url('admin/images/user.jpg') }}" alt="Default Profile Picture" class="img-thumbnail mb-2" width="100">
                                    <input type="file" name="new_default_profile_picture" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
<!-- /page content -->
@stop

@section('page_js')
<!-- Switchery -->
<script src="{{ url('admin/vendors/switchery/dist/switchery.min.js') }}"></script>
<script>
    // Switchery
    document.addEventListener("DOMContentLoaded", function() {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#26B99A',
                className: "switchery switchery-small"
            });
        });
    });
</script>
@stop
