@extends('layouts.main')

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
                            <div class="col-lg-12 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">Hi {{Auth::user()->name}}! 🎉</h5>
                                                <p class="mb-4">
                                                    Welcome to <span class="fw-bold">secure Share NFC Nexus</span> Empowering Seamless Information Sharing and Security
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img
                                                    src="../assets/master_ui/img/illustrations/man-with-laptop-light.png"
                                                    height="140"
                                                    alt="View Badge User"
                                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                    data-app-light-img="illustrations/man-with-laptop-light.png"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total Revenue -->
                            <!--/ Total Revenue -->
                            <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
                                <div class="row">
                                    <div class="col-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="../assets/master_ui/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Total Business Card</span>
                                                <h3 class="card-title text-nowrap mb-2">0 @if(isset($totalBusinessCards)) {{$totalBusinessCards}} @else {{session('totalBusinessCards')}}@endif</h3>
                                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="../assets/master_ui/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Total Secure Wallets</span>
                                                <h3 class="card-title mb-2">0 @if(isset($totalSecureWallets)) {{$totalSecureWallets}} @else {{session('totalSecureWallets')}}@endif</h3>
                                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +23.26%</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="../assets/master_ui/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Total Custom Card</span>
                                                <h3 class="card-title mb-2">0 @if(isset($totalCustomCards)) {{$totalCustomCards}} @else {{session('totalCustomCards')}}@endif</h3>
                                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +12.80%</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img
                                                            src="../assets/master_ui/img/icons/unicons/wallet-info.png"
                                                            alt="Credit Card"
                                                            class="rounded"
                                                        />
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Total Pet Tag</span>
                                                <h3 class="card-title text-nowrap mb-1">0 @if(isset($totalPetTags)) {{$totalPetTags}} @else {{session('totalPetTags')}}@endif</h3>
                                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +23.26%</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img
                                                            src="../assets/master_ui/img/icons/unicons/wallet-info.png"
                                                            alt="Credit Card"
                                                            class="rounded"
                                                        />
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Total Storage Tag</span>
                                                <h3 class="card-title text-nowrap mb-1">0 @if(isset($totalStorageTags)) {{$totalStorageTags}} @else {{session('totalStorageTags')}}@endif</h3>
                                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +23.26%</small>
                                            </div>
                                        </div>
                                    </div>
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
