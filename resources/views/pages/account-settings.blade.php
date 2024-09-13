@extends('layouts.master')

@section('content')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('layouts.navigation')

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('layouts.header_nav')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                @include('components.toaster')
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">


                        <div class="row fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
                            <div class="col-md-12">
                                <div class="nav-align-top">
                                    <ul class="nav nav-pills flex-column flex-md-row mb-6">
                                        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-sm bx-user me-1_5"></i> Account</a></li>
                                        <li class="nav-item"><a class="nav-link" href="/accountsecurity"><i class="bx bx-sm bx-lock-alt me-1_5"></i> Security</a></li>
                                    </ul>
                                </div>
                                <div class="card mb-6">
                                    <!-- Account -->

                                    <div class="card-body pt-4">
                                        <form id="formAccountSettings" class="fv-plugins-bootstrap5 fv-plugins-framework">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                                    <img src="@if(Auth::user()->avatar){{Auth::user()->avatar}} @else ../assets/master_ui/img/avatars/1.png @endif" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                                    <div class="button-wrapper">
                                                        <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                                            <span class="d-none d-sm-block">Upload new photo</span>
                                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                                            <input type="file" id="upload" class="account-file-input" hidden name="avatar" accept="image/png, image/jpeg, image/gif">
                                                        </label>
                                                        <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Reset</span>
                                                        </button>
                                                        <div>Allowed JPG, GIF or PNG. Max size of 800KB.</div>
                                                        <div class="invalid-feedback animated fadeInUp" id="error-avatar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-6">
                                                <div class="col-md-6 fv-plugins-icon-container form-group">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input class="form-control" type="text" id="name" name="name" value="{{Auth::user()->name}}" autofocus="">
                                                    <div class="invalid-feedback animated fadeInUp" id="error-name"></div>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="email" class="form-label">E-mail</label>
                                                    <input class="form-control" type="text" id="email" name="email" value="{{Auth::user()->email}}">
                                                    <div class="invalid-feedback animated fadeInUp" id="error-email"></div>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text">LK (+94)</span>
                                                        <input type="text" id="tel_no" name="tel_no" value="{{ Auth::user()->userDetail ? Auth::user()->userDetail->tel_no : '' }}" class="form-control" placeholder="202 555 0111">
                                                    </div>
                                                    <div class="invalid-feedback animated fadeInUp" id="error-tel_no"></div>
                                                </div>
                                                <div class="col-md-6 fv-plugins-icon-container">
                                                    <label for="nic" class="form-label">NIC Number</label>
                                                    <input class="form-control" type="text" id="nic" name="nic" value="{{ Auth::user()->userDetail ? Auth::user()->userDetail->nic : '' }}" autofocus="">
                                                    <div class="invalid-feedback animated fadeInUp" id="error-nic"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->userDetail ? Auth::user()->userDetail->address : '' }}" placeholder="Address">
                                                    <div class="invalid-feedback animated fadeInUp" id="error-address"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="town" class="form-label">Town</label>
                                                    <input type="text" class="form-control" id="town" name="town" value="{{ Auth::user()->userDetail ? Auth::user()->userDetail->town : '' }}" placeholder="town">
                                                    <div class="invalid-feedback animated fadeInUp" id="error-town"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="state" class="form-label">State / Province</label>
                                                    <input class="form-control" type="text" id="state" name="state" value="{{ Auth::user()->userDetail ? Auth::user()->userDetail->state : '' }}" placeholder="California">
                                                    <div class="invalid-feedback animated fadeInUp" id="error-state"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="zipCode" class="form-label">Post Code</label>
                                                    <input type="text" class="form-control" id="post_code" name="post_code" placeholder="231465" value="{{ Auth::user()->userDetail ? Auth::user()->userDetail->post_code : '' }}" maxlength="6">
                                                    <div class="invalid-feedback animated fadeInUp" id="error-post_code"></div>
                                                </div>
                                            </div>
                                            <div class="mt-6">
                                                <input hidden="" name="status" value="{{ Auth::user()->userDetail ? Auth::user()->userDetail->status : ''}}">
                                                <button type="submit" class="btn btn-primary me-3" id="submitButton">
                                                    <span id="spinner" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" style="display: none;"></span>
                                                    Save changes
                                                </button>
                                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                            </div>
                                            <input type="hidden"></form>
                                    </div>
                                    <!-- /Account -->
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
@endsection
