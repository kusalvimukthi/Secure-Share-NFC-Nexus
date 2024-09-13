@extends('layouts.master')

@section('content')
    <!-- Content wrapper -->
    @include('components.toaster')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">


            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-6">
                        <div class="user-profile-header-banner">
                            <img src="../assets/master_ui/img/avatars/profile_banner.png" alt="Banner image" class="rounded-top">
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">
                            <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
                                <img src="@if(Auth::user() && $customCard->user->avatar) {{$customCard->user->avatar}} @elseif(!Auth::user() && $avatar) {{$avatar}} @else ../assets/master_ui/img/avatars/1.png @endif" alt="user image" class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img">
                            </div>
                            <div class="flex-grow-1 mt-3 mt-lg-5">
                                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4 class="mb-2 mt-lg-7">@if(Auth::user()) {{$customCard->user->name}} @elseif(!Auth::user() && $name) {{$name}} @else NA @endif</h4>
                                        <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                            <li class="list-inline-item">
                                                <i class="bx bx-map me-2 align-top"></i><span class="fw-medium">@if(Auth::user() && $customCard->user->userDetail) {{$customCard->user->userDetail->address}} @elseif(!Auth::user() && $address) {{$address}} @else NA @endif</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="bx bx-calendar me-2 align-top"></i><span class="fw-medium"> Joined  @if(Auth::user()) {{\Carbon\Carbon::parse(Auth::user()->created_at)->format('M Y')}} @elseif(!Auth::user() && $createdDate) {{$createdDate}} @else NA @endif</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        @if(Auth::user() && Auth::user()->hasRole('admin') && isset($copy_link))
                                        <a id="custom-card-copy" href="" data-link="{{$copy_link}}" class="btn btn-primary mb-1 copy-link-btn">
                                            <i class="bx bx-link-alt bx-sm me-1_5"></i>Copy Link
                                        </a>
                                        @endif
                                        @if(Auth::user())
                                        <a href="/custom-card-update/{{$customCard->id}}" class="btn btn-primary mb-1">
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

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/master_ui/js/custom-card/custom-card.js')}}"></script>
@endsection
