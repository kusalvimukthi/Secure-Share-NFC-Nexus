@extends('layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Reset Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="/login" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                            <style type="text/css">
                                .st0{fill:#5F61E6;}
                                .st1{fill:#FFFFFF;}
                            </style>
                            <g>
                                <ellipse transform="matrix(0.1639 -0.9865 0.9865 0.1639 -3.7586 45.5656)" class="st0" cx="25" cy="25" rx="24.8" ry="24.8"/>
                                <g>
                                <path class="st1" d="M9.2,23c-0.4,0-0.8-0.1-1.1-0.4c-0.8-0.6-0.9-1.7-0.3-2.5c0.4-0.5,2.1-2.3,4.8-4.1c3.5-2.3,7.3-3.7,11.1-3.9
                                    c6.4-0.4,12.6,2.2,18.4,7.8c0.7,0.7,0.7,1.8,0,2.5c-0.7,0.7-1.8,0.7-2.5,0c-5-4.8-10.2-7.1-15.5-6.8c-4,0.2-7.3,1.9-9.4,3.3
                                    c-2.3,1.5-3.8,3.1-4.1,3.4C10.3,22.8,9.7,23,9.2,23z M14.7,26.9c0.4-0.5,4.2-4.6,9.6-4.9c3.7-0.2,7.4,1.5,11.1,5
                                    c0.7,0.7,1.9,0.7,2.5-0.1c0.7-0.7,0.7-1.9-0.1-2.5c-4.4-4.2-9-6.2-13.7-6c-6.8,0.3-11.3,5.1-12.2,6.1c-0.7,0.7-0.6,1.9,0.2,2.5
                                    c0.3,0.3,0.8,0.4,1.2,0.4C13.9,27.5,14.4,27.3,14.7,26.9z M19,31.5c0.3-0.6,2.4-2.7,5.2-3c2.4-0.3,4.7,0.9,7,3.3
                                    c0.7,0.7,1.8,0.8,2.5,0.1c0.7-0.7,0.8-1.8,0.1-2.5c-3.9-4.2-7.6-4.7-10-4.4c-4.1,0.4-7.1,3.4-7.9,4.8c-0.5,0.9-0.2,2,0.6,2.5
                                    c0.3,0.2,0.6,0.3,0.9,0.3C18,32.3,18.6,32,19,31.5z M25,31.9c-1.9,0-3.4,1.5-3.4,3.4c0,1.9,1.5,3.4,3.4,3.4c1.9,0,3.4-1.5,3.4-3.4
                                    C28.5,33.5,27,31.9,25,31.9z"/>
                                </g>
                            </g>
                            </svg>
                        </span>
                                <span class="app-brand-text demo text-body fw-bold">NFC Nexus</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Set New Password 🔒</h4>
                        <p class="mb-4">for <span class="fw-medium">@if(session('verify_email')) {{ session('verify_email') }} @endif</span></p>
                        <form id="setNewPassword" class="mb-3" method="POST">
                            <div class="mb-3 form-password-toggle form-group">
                                <label class="form-label" for="password">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <div id="password-strength" class="text-danger"></div>
                            </div>
                            <div class="mb-3 form-password-toggle form-group">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="confirm-password" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <div id="password-strength" class="text-danger"></div>
                            </div>
                            <input type="hidden" id="user-name" value="@if(session('verify_user_name')) {{session('verify_user_name')}} @endif"> <!-- Example, this should be dynamic -->
                            <button class="btn btn-primary d-grid w-100 mb-3">
                                Set new password
                            </button>
                            <div class="text-center">
                                <a href="/login">
                                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                    Back to login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Reset Password -->
            </div>
        </div>
    </div>
@endsection