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


                        <!-- Header -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-6">
                                    <div class="user-profile-header-banner">
                                        <img src="../assets/master_ui/img/avatars/profile_banner.png" alt="Banner image"
                                             class="rounded-top">
                                    </div>
                                    <div
                                        class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">
                                        <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
                                            <img src="{{ $user->avatar ?  : '../assets/master_ui/img/avatars/1.png' }}"
                                                 alt="user image"
                                                 class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img">
                                        </div>
                                        <div class="flex-grow-1 mt-3 mt-lg-5">
                                            <div
                                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                                <div class="user-profile-info">
                                                    <h4 class="mb-2 mt-lg-7">{{$user->name}}</h4>
                                                    <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                                        <li class="list-inline-item">
                                                            <i class="bx bx-map me-2 align-top"></i><span
                                                                class="fw-medium">@if($user->userDetail)
                                                                    {{$user->userDetail->address}}
                                                                @else
                                                                    N/A
                                                                @endif</span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class="bx bx-calendar me-2 align-top"></i><span
                                                                class="fw-medium"> Joined {{\Carbon\Carbon::parse($user->created_at)->format('M Y')}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @if(Auth::user()->id === $user->id)
                                                    <a href="/accountsettings" class="btn btn-primary mb-1">
                                                        <i class="bx bx-user-check bx-sm me-2"></i>Edit Profile
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Header -->


                        <!-- User Profile Content -->
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <!-- About User -->
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <small class="card-text text-uppercase text-muted small">About</small>
                                        <ul class="list-unstyled my-3 py-1">
                                            <li class="d-flex align-items-center mb-4"><i class="bx bx-user"></i><span
                                                    class="fw-medium mx-2">Full Name:</span>
                                                <span>{{$user->name}}</span></li>
                                            <li class="d-flex align-items-center mb-4">
                                                <i class="bx bx-check"></i>
                                                <span class="fw-medium mx-2">Status:</span>
                                                <span>
                                                    @if($user->userDetail)
                                                        @if($user->userDetail->status == 'true')
                                                            <span class="badge bg-label-success w-100">active</span>
                                                        @else
                                                            <span class="badge bg-label-danger w-100">deactive</span>
                                                        @endif
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                            </li>
                                            <li class="d-flex align-items-center mb-4"><i class="bx bx-crown"></i><span
                                                    class="fw-medium mx-2">Role:</span>
                                                <span>{{$user->getRoleNames()->first()}}</span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="bx bx-flag"></i><span
                                                    class="fw-medium mx-2">NIC Number:</span> <span>@if($user->userDetail)
                                                        {{$user->userDetail->nic}}
                                                    @else
                                                        N/A
                                                    @endif</span></li>
                                        </ul>
                                        <small class="card-text text-uppercase text-muted small">Contacts</small>
                                        <ul class="list-unstyled my-3 py-1">
                                            <li class="d-flex align-items-center mb-4"><i class="bx bx-phone"></i><span
                                                    class="fw-medium mx-2">Contact:</span> <span>@if($user->userDetail)
                                                        {{$user->userDetail->tel_no}}
                                                    @else
                                                        N/A
                                                    @endif</span></li>
                                            <li class="d-flex align-items-center mb-4"><i
                                                    class="bx bx-envelope"></i><span
                                                    class="fw-medium mx-2">Email:</span> <span>{{$user->email}}</span>
                                            </li>
                                            <li class="d-flex mb-4"><i class="bx bx-location-plus"></i><span
                                                    class="fw-medium mx-2">Address:</span> <span>@if($user->userDetail)
                                                        {{$user->userDetail->address}}
                                                    @else
                                                        N/A
                                                    @endif</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--/ About User -->
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7">
                                <!-- Projects table -->
                                <div class="card mb-6">
                                    <h5 class="card-header pb-0 text-sm-start text-center">Your Card List</h5>
                                    <div class="card-datatable table-responsive text-nowrap">
                                        @component('components.data-tables', [
                                            'tableId' => 'combined-card-table',
                                            'columns' => [
                                                ['title' => '', 'data' => null],
                                                ['title' => 'Card Type', 'data' => 'card_type'],  // New column header for card type
                                                ['title' => 'Card info', 'data' => 'name'],
                                                ['title' => 'Email', 'data' => 'email'],
                                                ['title' => 'Status', 'data' => 'status'],
                                                ['title' => 'View Card', 'data' => 'action'],
                                            ]
                                        ])
                                        @endcomponent
                                    </div>
                                </div>
                                <!--/ Projects table -->
                            </div>
                        </div>
                        <!--/ User Profile Content -->

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
