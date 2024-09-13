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
                    @include('components.toaster')
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> User Table</h4>

                        <div class="row g-4 mb-4">
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span>Total Users</span>
                                                <div class="d-flex align-items-end mt-2">
                                                    <h4 class="mb-0 me-2">0{{$allUsers}}</h4>
                                                </div>
                                                <p class="mb-0">Year to Date</p>
                                            </div>
                                            <div class="avatar">
                      <span class="avatar-initial rounded bg-label-primary">
                        <i class="bx bx-user bx-sm"></i>
                      </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span>Deactivate Users</span>
                                                <div class="d-flex align-items-end mt-2">
                                                    <h4 class="mb-0 me-2">0{{$inactiveUserCount}}</h4>
                                                </div>
                                                <p class="mb-0">Year to Date</p>
                                            </div>
                                            <div class="avatar">
                      <span class="avatar-initial rounded bg-label-danger">
                        <i class="bx bx-user-check bx-sm"></i>
                      </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span>Active Users</span>
                                                <div class="d-flex align-items-end mt-2">
                                                    <h4 class="mb-0 me-2">0{{$activeUsersCount}}</h4>
                                                </div>
                                                <p class="mb-0">Year to Date</p>
                                            </div>
                                            <div class="avatar">
                      <span class="avatar-initial rounded bg-label-success">
                        <i class="bx bx-group bx-sm"></i>
                      </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Responsive Table -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd"> Add New
                                    User
                                </button>
                            </div>
                            <div class="card-datatable table-responsive text-nowrap">
                                @component('components.data-tables', [
                                    'tableId' => 'users-table',
                                    'columns' => [
//                                        ['title' => '', 'data' => null],
                                        ['title' => '', 'data' => null],
                                        ['title' => 'ID', 'data' => 'id'],
                                        ['title' => 'Name', 'data' => 'name'],
                                        ['title' => 'Email', 'data' => 'email'],
                                        ['title' => 'NIC Number', 'data' => 'nic'],
                                        ['title' => 'User Type', 'data' => 'user_type'],
                                        ['title' => 'Status', 'data' => 'status'],
                                        ['title' => 'Action', 'data' => 'action'],
                                    ]
                                ])
                                @endcomponent
                            </div>
                        </div>
                        <!--/ Responsive Table -->
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd"
                             aria-labelledby="offcanvasEndLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasEndLabel" class="offcanvas-title">Create New User</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body mx-0 flex-grow-0">

                                <form id="create_customer"
                                      class="ecommerce-customer-add pt-0 fv-plugins-bootstrap5 fv-plugins-framework">
                                    <div class="ecommerce-customer-add-basic mb-4">
                                        <h6 class="mb-3">Basic Information</h6>
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="ecommerce-customer-add-name">Name*</label>
                                            <input type="text" class="form-control" id="ecommerce-customer-add-name"
                                                   placeholder="John Doe" name="name" aria-label="John Doe">
                                            <div class="invalid-feedback" id="error-name"></div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="ecommerce-customer-add-email">Email*</label>
                                            <input type="text" id="ecommerce-customer-add-email" class="form-control"
                                                   placeholder="john.doe@example.com" aria-label="john.doe@example.com"
                                                   name="email">
                                            <div class="invalid-feedback" id="error-email"></div>
                                        </div>
{{--                                        <div class="mb-3 form-group">--}}
{{--                                            <label class="form-label"--}}
{{--                                                   for="ecommerce-customer-add-contact">Mobile</label>--}}
{{--                                            <input type="text" id="ecommerce-customer-add-contact"--}}
{{--                                                   class="form-control phone-mask" placeholder="+(123) 456-7890"--}}
{{--                                                   aria-label="+(123) 456-7890" name="tel_no">--}}
{{--                                            <div class="invalid-feedback" id="error-tel_no"></div>--}}
{{--                                        </div>--}}
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="ecommerce-customer-add-contact">Phone Number</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">LK (+94)</span>
                                                <input type="text" id="ecommerce-customer-add-contact" name="tel_no" value="" class="form-control" placeholder="202 555 0111">
                                            </div>
                                            <div class="invalid-feedback animated fadeInUp" id="error-tel_no"></div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="customer-nic">NIC Number</label>
                                            <input type="text" id="customer-nic" class="form-control phone-mask"
                                                   placeholder="9715......V" aria-label="9715......V" name="nic">
                                            <div class="invalid-feedback" id="error-nic"></div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label for="defaultSelect" class="form-label">User Type</label>
                                            <select id="defaultSelect" class="form-select" name="user_type">
                                                <option>Select user type...</option>
                                                <option value="1">Administrator</option>
                                                <option value="2">Supervisor</option>
                                                <option value="3">Customer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ecommerce-customer-add-shiping mb-3 pt-2" data-select2-id="6">
                                        <h6 class="mb-3">Other Information</h6>
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="customer-add-address">Address</label>
                                            <input type="text" id="customer-add-address" class="form-control"
                                                   aria-label="address" name="address">
                                            <div class="invalid-feedback" id="error-address"></div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="ecommerce-customer-add-town">Town</label>
                                            <input type="text" id="ecommerce-customer-add-town" class="form-control"
                                                   placeholder="New York" aria-label="New York" name="town">
                                            <div class="invalid-feedback" id="error-town"></div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="ecommerce-customer-add-state">State /
                                                Province</label>
                                            <input type="text" id="ecommerce-customer-add-state" class="form-control"
                                                   placeholder="Southern tip" aria-label="Southern tip" name="state">
                                            <div class="invalid-feedback" id="error-state"></div>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="ecommerce-customer-add-post-code">Post
                                                Code</label>
                                            <input type="text" id="ecommerce-customer-add-post-code"
                                                   class="form-control" placeholder="734990" aria-label="734990"
                                                   name="post_code" maxlength="8">
                                            <div class="invalid-feedback" id="error-post_code"></div>
                                        </div>
                                        {{--                <div class="mb-3">--}}
                                        {{--                  <label class="form-label" for="basic-icon-default-message">Post Code</label>--}}
                                        {{--                  <textarea id="basic-icon-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?" aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>--}}
                                        {{--                </div>--}}
                                    </div>
                                    <div class="d-sm-flex mb-3">
                                        <div class="me-auto mb-2 mb-md-0">
                                            <h6 class="mb-1">User Account Status</h6>
                                            <small>Use this toggle to enable or disable the user account.</small>
                                        </div>
                                        <div class="form-check form-switch my-auto me-n2">
                                            <input type="checkbox" id="status_checkbox" class="form-check-input" checked="" name="status">
                                        </div>
                                    </div>
                                    <div>
                                        <input id="form-type" value="create" hidden="">
                                        <input name="user_id" id="user_id" value="" hidden="">
{{--                                        <button id="customer-submit-btn" type="submit" class="btn btn-primary me-sm-3 data-submit">Add User--}}
{{--                                        </button>--}}
                                        <button id="customer-submit-btn" type="submit" class="btn btn-primary me-sm-3 data-submit">
                                            <span id="spinner" class="spinner-grow me-1" role="status" aria-hidden="true" style="display: none;"></span>
                                            Add User
                                        </button>
                                        <button type="reset" class="btn btn-label-danger" id="userDiscard"
                                                data-bs-dismiss="offcanvas">Discard
                                        </button>
                                    </div>
                                    <input type="hidden">
                                </form>
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
