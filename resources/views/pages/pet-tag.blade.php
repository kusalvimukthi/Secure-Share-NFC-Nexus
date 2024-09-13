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
                            <img src="../assets/master_ui/img/avatars/profile_banner2.jpg" alt="Banner image" class="rounded-top">
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">
                            <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
                                <img src="@if($tag->avatar) {{$tag->avatar}} @else ../assets/master_ui/img/avatars/1.png @endif" alt="user image" class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img">
                            </div>
                            <div class="flex-grow-1 mt-3 mt-lg-5">
                                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4 class="mb-2 mt-lg-7">{{$tag->pet_name}}</h4>
                                        <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                            <li class="list-inline-item">
                                                <i class="bx bx-phone me-2 align-top" ></i><span class="fw-medium"><a href="tel:{{$tag->tel_no}}">{{$tag->tel_no}}</a></span>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="bx bx-map me-2 align-top"></i><span class="fw-medium">{{$tag->address}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        @if(Auth::user() && Auth::user()->hasRole('admin') && isset($copy_link))
                                        <a href="" data-link="{{$copy_link}}" class="btn btn-primary mb-1 copy-link-btn">
                                            <i class="bx bx-link-alt bx-sm me-1_5"></i>Copy Link
                                        </a>
                                        @endif
                                        @if(Auth::user())
                                        <a href="/pet-tag-update/{{$tag->id}}" class="btn btn-primary mb-1">
                                            <i class="bx bx-cog bx-sm me-1_5"></i>Manage Pet Tag
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
                            <h5>Pet Owner Details</h5>
                            <ul class="list-unstyled my-3 py-1">
                                <li class="d-flex align-items-center mb-4"><i class="bx bx-user"></i><span class="fw-medium mx-2">Name:</span> <span>{{$tag->name}}</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="bx bx-phone"></i><span class="fw-medium mx-2">Contact:</span> <span>{{$tag->tel_no}}</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="bx bx-envelope"></i><span class="fw-medium mx-2">Email:</span> <span>{{$tag->email}}</span></li>
                                <li class="d-flex align-items-center mb-4"><i class='bx bx-location-plus' ></i><span class="fw-medium mx-2">Address:</span> <span>{{$tag->address}}</span></li>
                            </ul>
                            <h5>Pet Details</h5>
                            <ul class="list-unstyled my-3 py-1">
                                <li class="d-flex align-items-center mb-4"><i class='bx bxl-baidu'></i><span class="fw-medium mx-2">Pet Name:</span> <span>{{$tag->pet_name}}</span></li>
                                <li class="d-flex align-items-center mb-2"><i class='bx bxs-calendar' ></i><span class="fw-medium mx-2">DOB:</span> <span>{{$tag->date_of_birth}}</span></li>
                            </ul>
                            <small class="card-text text-uppercase text-muted small">Bio</small>
                            <ul class="list-unstyled my-3 py-1">
                                <p>{{$tag->bio}}</p>
                            </ul>
                        </div>
                    </div>
                    <!--/ About User -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card mb-6">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                    <tr class="text-nowrap">
                                        <th>#</th>
                                        <th>Vaccine Name</th>
                                        <th>Vaccination Date</th>
                                        <th>Next Vaccination Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vaccinations as $index => $vaccine)
                                        <tr>
                                            <th scope="row">{{++$index}}</th>
                                            <td>{{$vaccine->vaccine}}</td>
                                            <td>{{$vaccine->vaccination_date}}</td>
                                            <td>{{$vaccine->next_vaccination_date}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
