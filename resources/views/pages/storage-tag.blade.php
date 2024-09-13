@extends('layouts.master')

@section('content')
    @include('components.toaster')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">


            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-6">
                        <div class="user-profile-header-banner">
                            <img src="../assets/master_ui/img/avatars/profile_banner4.jpg" alt="Banner image" class="rounded-top">
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">
                            <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
                                <img src="@if($storageTag->avatar) {{$storageTag->avatar}} @else ../assets/master_ui/img/avatars/1.png @endif" alt="user image" class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img">
                            </div>
                            <div class="flex-grow-1 mt-3 mt-lg-5">
                                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4 mt-lg-4">
                                    <div class="user-profile-info">
                                        <h4 class="mb-2 mt-lg-7">{{$storageTag->product_name}}</h4>
                                    </div>
                                    <div>
                                        @if(Auth::user() && Auth::user()->hasRole('admin') && isset($copy_link))
                                        <a href="" data-link="{{$copy_link}}" class="btn btn-primary mb-1 copy-link-btn">
                                            <i class="bx bx-link-alt bx-sm me-1_5"></i>Copy Link
                                        </a>
                                        @endif
                                        @if(Auth::user())
                                        <a href="/storage-tag-update/{{$storageTag->id}}" class="btn btn-primary mb-1">
                                            <i class="bx bx-cog bx-sm me-1_5"></i>Manage Storage Tag
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Header -->


            <!-- User Profile Content -->
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <!-- About User -->

                    <div class="card mb-6">
                        <div class="card-body">
                            <h5>Storage Details</h5>
                            <ul class="list-unstyled my-3 py-1">
                                <li class="d-flex align-items-center mb-4"><i class='bx bx-purchase-tag' ></i><span class="fw-medium mx-2">Product Name:</span> <span>{{$storageTag->product_name}}</span></li>
                                <li class="d-flex align-items-center mb-4"><i class='bx bx-cube' ></i><span class="fw-medium mx-2">Product Weight:</span> <span>{{$storageTag->product_weight}} KG</span></li>
                                <li class="d-flex align-items-center mb-4"><i class='bx bx-calendar' ></i><span class="fw-medium mx-2">Manufacture date:</span> <span>{{$storageTag->manufactured_date}}</span></li>
                                <li class="d-flex align-items-center mb-4"><i class='bx bx-calendar-x' ></i><span class="fw-medium mx-2">expir date :</span> <span>{{$storageTag->expiration_date}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <!--/ About User -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card mb-6">
                        <div class="card-body">
                            <h5>Product Details</h5>
                            <ul class="list-unstyled my-3 py-1">
                                {{$storageTag->product_details}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ User Profile Content -->

        </div>


        <!-- / Content -->
        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">© Copyright
                    <script>
                        document.write(new Date().getFullYear());
                    </script>.<a href="https://secureshare.novatechlane.net/login" target="_blank" class="footer-link fw-bolder"> Secure Share NFC Nexus</a>
                </div>
            </div>
        </footer>
        <!-- / Footer -->
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
