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
{{--                        <div class="row">--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="card mb-6">--}}
{{--                                    <div class="user-profile-header-banner">--}}
{{--                                        <img src="../assets/master_ui/img/avatars/profile_banner.png" alt="Banner image" class="rounded-top">--}}
{{--                                    </div>--}}
{{--                                    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">--}}
{{--                                        <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">--}}
{{--                                            <img src="@if(Auth::user()->avatar) {{Auth::user()->avatar}} @else ../assets/master_ui/img/avatars/1.png @endif" alt="user image" class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img">--}}
{{--                                        </div>--}}
{{--                                        <div class="flex-grow-1 mt-3 mt-lg-5">--}}
{{--                                            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">--}}
{{--                                                <div class="user-profile-info">--}}
{{--                                                    <h4 class="mb-2 mt-lg-7">{{Auth::user()->name}}</h4>--}}
{{--                                                    <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">--}}
{{--                                                        <li class="list-inline-item">--}}
{{--                                                            <i class="bx bx-map me-2 align-top"></i><span class="fw-medium">{{Auth::user()->userDetail->address}}</span>--}}
{{--                                                        </li>--}}
{{--                                                        <li class="list-inline-item">--}}
{{--                                                            <i class="bx bx-calendar me-2 align-top"></i><span class="fw-medium"> Joined {{\Carbon\Carbon::parse(Auth::user()->created_at)->format('M Y')}}</span>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!--/ Header -->


                        <!-- User Profile Content -->
                        <div class="row g-6">
                            @foreach($tags as $tag)
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-header pb-4">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <h5 class="mb-0 text-heading">Pet Tag</h5>
                                                </div>
                                                <div class="bg-lighter px-3 py-2 rounded">
                                                    <p class="mb-1"><span class="fw-medium text-heading">Created Date: </span>{{\Carbon\Carbon::parse($tag->created_at)->format('Y-m-d')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pb-1">
                                            <div class="d-flex align-items-center flex-wrap">
                                                <ul class="list-unstyled my-3 py-1">
                                                    <li class="d-flex align-items-center mb-4"><i class='bx bxl-baidu'></i><span class="fw-medium mx-2">Pet Name :</span> <span>{{$tag->pet_name}}</span></li>
                                                    <li class="d-flex align-items-center mb-4"><i class='bx bx-phone-call'></i><span class="fw-medium mx-2">Owner Telephone :</span> <span>{{$tag->tel_no}}</span></li>
                                                    <li class="d-flex align-items-center"><i class='bx bx-badge-check'></i><span class="fw-medium mx-2">Status type :</span> <span class="badge bg-label-{{ $tag->status ? 'success' : 'danger' }}">{{ $tag->status ? 'active' : 'deactive' }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body border-top">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <a href="/pet-tag/{{$tag->id}}" class="btn btn-primary d-flex align-items-center me-4"><i class='bx bx-show-alt bx-sm me-2'></i>View Pet Tag</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
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
