@extends('layouts.main')

@section('content')
    @include('components.toaster')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Verify Email -->
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
                        <h3 class="mb-2">Verify your email ✉️</h3>
                        <p class="text-start">To ensure the security of your account, please verify your new email address. We have sent a verification link to your updated email. Click the link in the email to complete the verification process.</p>
                        <p class="text-start">If you did not receive the email, please check your spam or junk folder, or click the button below to resend the verification email.</p>
                        <p class="text-center">Didn't get the mail?
                            <a href="javascript:void(0);" id="resendEmail">
                                Resend
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Verify Email -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#resendEmail').on('click', function (e){
            e.preventDefault();
            $.ajax({
                url: "/resend-verification",
                type: 'GET',
                success: function(response) {
                    showToast('Verification email sent successfully. Please check your inbox', 'Success', 'bg-success');
                },
                error: function(xhr) {
                    console.log(xhr)
                    showToast('Please correct the errors in the form', 'Error', 'bg-danger');
                }
            });
        })
    </script>
@endsection
