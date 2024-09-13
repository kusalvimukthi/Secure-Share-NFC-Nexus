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
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="nav-align-top">
                                    <ul class="nav nav-pills flex-column flex-md-row mb-6">
                                        <li class="nav-item"><a class="nav-link" href="accountsettings"><i
                                                    class="bx-sm bx bx-user me-1_5"></i> Account</a></li>
                                        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                                                    class="bx-sm bx bx-lock-alt me-1_5"></i> Security</a></li>
                                    </ul>
                                </div>
                                <!-- Change Password -->
                                <div class="card mb-6">
                                    <h5 class="card-header">Change Password</h5>
                                    <div class="card-body pt-1">
                                        <form id="formAccountPassword"
                                              class="fv-plugins-bootstrap5 fv-plugins-framework">
                                            <div class="row">
                                                <div
                                                    class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container form-group">
                                                    <label class="form-label" for="currentPassword">Current
                                                        Password</label>
                                                    <div class="input-group input-group-merge has-validation">
                                                        <input class="form-control" type="password"
                                                               name="current_password" id="current_password"
                                                               placeholder="············">
                                                        <span class="input-group-text cursor-pointer"><i
                                                                class="bx bx-hide"></i></span>
                                                    </div>
                                                    <div class="invalid-feedback" id="error-current_password"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container form-group">
                                                    <label class="form-label" for="newPassword">New Password</label>
                                                    <div class="input-group input-group-merge has-validation">
                                                        <input class="form-control" type="password" id="password"
                                                               name="password" placeholder="············">
                                                        <span class="input-group-text cursor-pointer"><i
                                                                class="bx bx-hide"></i></span>

                                                    </div>
                                                    <div class="invalid-feedback" id="error-password"></div>
                                                </div>

                                                <div
                                                    class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container form-group">
                                                    <label class="form-label" for="confirmPassword">Confirm New
                                                        Password</label>
                                                    <div class="input-group input-group-merge has-validation">
                                                        <input class="form-control" type="password"
                                                               name="password_confirmation" id="password_confirmation"
                                                               placeholder="············">
                                                        <span class="input-group-text cursor-pointer"><i
                                                                class="bx bx-hide"></i></span>
                                                    </div>
                                                    <div class="invalid-feedback" id="error-password_confirmation"></div>
                                                </div>
                                            </div>
                                            <h6 class="text-body">Password Requirements:</h6>
                                            <ul class="ps-4 mb-0">
                                                <li class="mb-4">Minimum 8 characters long - the more, the better</li>
                                                <li class="mb-4">At least one lowercase character</li>
                                                <li>At least one number, symbol, or whitespace character</li>
                                            </ul>
                                            <div class="mt-6">
                                                <button type="submit" class="btn btn-primary me-3">
                                                    <span id="spinner" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" style="display: none;"></span>
                                                    Save changes
                                                </button>
                                                <button type="reset" class="btn btn-label-secondary">Reset</button>
                                            </div>
                                            <input type="hidden"></form>
                                    </div>
                                </div>
                                <!--/ Change Password -->
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
