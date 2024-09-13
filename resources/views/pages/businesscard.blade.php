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
                            <img src="../assets/master_ui/img/avatars/profile_banner1.jpg" alt="Banner image" class="rounded-top">
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">
                            <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
                                <img src="{{$card->avatar}}" alt="user image" class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img">
                            </div>
                            <div class="flex-grow-1 mt-3 mt-lg-5">
                                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4 class="mb-2 mt-lg-7">{{$card->name}}</h4>
                                        <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                            <li class="list-inline-item">
                                                <i class='bx bx-briefcase-alt me-2 align-top'></i><span class="fw-medium">{{$card->designation}}</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="bx bx-map me-2 align-top"></i><span class="fw-medium">{{$card->address}}</span>
                                            </li>
{{--                                            <li class="list-inline-item">--}}
{{--                                                <i class="bx bx-calendar me-2 align-top"></i><span class="fw-medium"> Joined {{\Carbon\Carbon::parse(Auth::user()->created_at)->format('M Y')}}</span>--}}
{{--                                            </li>--}}
                                        </ul>
                                    </div>
                                    <div class="demo-inline-spacing">
                                        @foreach($socialLinks as $k => $v)
                                            <a href="{{$v}}" class="btn btn-icon btn-{{$k}}"><i class="tf-icons bx bxl-{{$k}} bx-22px"></i></a>
                                        @endforeach
                                            @if(Auth::user() && Auth::user()->hasRole('admin') && isset($copy_link))
                                            <a href="" data-link="{{$copy_link}}" class="btn btn-primary mb-1 copy-link-btn">
                                                <i class="bx bx-link-alt bx-sm me-1_5"></i>Copy Link
                                            </a>
                                            @endif
                                            @if(Auth::user())
                                            <a href="/business-card-update/{{$card->id}}" class="btn btn-primary mb-1">
                                                <i class="bx bx-cog bx-sm me-1_5"></i>Manage Card
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
                            <small class="card-text text-uppercase text-muted small">About</small>
                            <ul class="list-unstyled my-3 py-1">
                                <li class="d-flex align-items-center mb-4"><i class="bx bx-user"></i><span class="fw-medium mx-2">Full Name :</span> <span>{{$card->name}}</span></li>
                                <li class="d-flex align-items-center mb-4"><i class='bx bx-buildings'></i><span class="fw-medium mx-2">Company Name :</span> <span>{{$card->company_name}}</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="bx bx-crown"></i><span class="fw-medium mx-2">Designation :</span> <span>{{$card->designation}}</span></li>
                                <li class="mb-4"><i class="bx bx-flag"></i><span class="fw-medium mx-2">Bio </span> <span class="d-block mt-3">{{$card->bio}}</span></li>
                            </ul>
                            <small class="card-text text-uppercase text-muted small">Contacts</small>
                            <ul class="list-unstyled my-3 py-1">
                                <li class="d-flex align-items-center mb-4"><i class="bx bx-phone"></i><span class="fw-medium mx-2">Contact:</span> <span>{{$card->tel_no}}</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="bx bx-envelope"></i><span class="fw-medium mx-2">Email:</span> <span>{{$card->email}}</span></li>
                                <li class="d-flex mb-4"><i class='bx bx-location-plus' ></i><span class="fw-medium mx-2">Address:</span> <span>{{$card->address}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <!--/ About User -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    @if ($links['web_url'] || $links['portfolio'])
                    <div class="card mb-6">
                        <div class="card-body">
                            @if ($links['web_url'])
                                <div class="d-flex mb-4 align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="../assets/master_ui/img/icons/brands/web.png" alt="dribbble" class="me-4" height="32">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Website link</h6>
                                    <a href="{{$links['web_url']}}" target="_blank" class="small">{{$links['web_url']}}</a>
                                </div>
                            </div>
                            @endif
                            @if($links['portfolio'])
                                <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="../assets/master_ui/img/icons/brands/portfolio.png" alt="behance" class="me-4" height="32">
                                </div>
                                <div class="flex-grow-1  align-items-center">
                                    <h6 class="mb-0">Portfolio url</h6>
                                    <a href="{{$links['portfolio']}}" target="_blank" class="small">{{$links['portfolio']}}</a>
                                </div>
                            </div>
                            @endif
                                <!-- /Social Accounts -->
                        </div>
                    </div>
                    @endif
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
