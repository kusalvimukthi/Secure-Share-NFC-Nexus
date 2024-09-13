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
                            <img src="../assets/master_ui/img/avatars/profile_banner3.jpg" alt="Banner image" class="rounded-top">
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">
                            <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
                                <img src="@if(Auth::user() && $wallet->user->avatar) {{$wallet->user->avatar}} @elseif(!Auth::user() && $avatar) {{$avatar}} @else ../assets/master_ui/img/avatars/1.png @endif" alt="user image" class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img">
                            </div>
                            <div class="flex-grow-1 mt-3 mt-lg-5">
                                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4 class="mb-2 mt-lg-7">{{$wallet->user->name}}</h4>
                                        <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                            <li class="list-inline-item">
                                                <i class="bx bx-map me-2 align-top"></i><span class="fw-medium">{{$wallet->user->userDetail->address}}</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="bx bx-calendar me-2 align-top"></i><span class="fw-medium"> Card Created On {{\Carbon\Carbon::parse($wallet->created_at)->format('M Y')}}</span>
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
                                        <a href="/wallet-update/{{$wallet->id}}" class="btn btn-primary mb-1">
                                            <i class="bx bx-cog bx-sm me-1_5"></i>Manage wallet
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
                            <h5>Website Passwords</h5>
                            <p class="mb-6">Easily manage and access all your saved passwords for various websites. Ensuring your online accounts remain secure and easily accessible.</p>
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach($credentials as $index => $cred)
                                        <div class="bg-lighter rounded p-4 mb-6 position-relative">
                                            <div class="d-flex align-items-center mb-2">
                                                <h5 class="mb-0 me-3">Site URL</h5>
                                                <a href="{{$cred->url}}" target="_blank"><span class="badge bg-label-primary">Click here</span></a>
                                            </div>
                                            <div class="row">
                                                <div class="mb-6 col-md-6">
                                                    <label class="form-label" for="username-{{$index}}">Username</label>
                                                    <div class="input-group input-group-merge">
                                                        <!-- Update the input ID to use the dynamic index -->
                                                        <input class="form-control" type="text" id="username-{{$index}}" name="username" placeholder="Enter your username" value="{{$cred->username}}">
                                                        <!-- Update the onclick to reference the dynamic ID -->
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-copy" onclick="copyToClipboard('username-{{$index}}')"></i></span>
                                                    </div>
                                                </div>
                                                <div class="mb-6 col-md-6">
                                                    <label class="form-label" for="password-{{$index}}">Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <!-- Update the input ID to use the dynamic index -->
                                                        <input class="form-control" type="password" id="password-{{$index}}" name="password" placeholder="············" value="{{$cred->password}}">
                                                        <!-- Update the onclick to reference the dynamic ID -->
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-copy" onclick="copyToClipboard('password-{{$index}}')"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-muted">Created on {{\Carbon\Carbon::parse($wallet->created_at)->format('d M Y H:i:s')}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ About User -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card mb-6">
                        <div class="card-body">
                            <small class="card-text text-uppercase text-muted small">Editor Notes</small>
                            <div>
                                {!! $wallet->editor_data !!}
                            </div>
                            <small class="card-text text-uppercase text-muted small">Extra Note</small>
                            <p>{{$wallet->note}}</p>
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
