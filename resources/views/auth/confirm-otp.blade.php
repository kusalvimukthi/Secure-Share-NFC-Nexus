@extends('layouts.main')

@section('content')
    @include('components.toaster')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!--  Two Steps Verification -->
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
                        <h4 class="mb-2">Two Step Verification 💬</h4>
                        <p class="text-start mb-4">
                            We sent a verification code to below email address. Please check your inbox and enter the verification code.
                            <span class="fw-medium d-block mt-2" id="userEmail">{{session()->get('otp_verify_user_email')}}</span>
                        </p>
                        <p class="mb-0 fw-medium">Type your 6 digit security code</p>
                        <form id="verifyOtpForm">
                            <div class="mb-3">
                                <div class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" autofocus>
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1">
                                </div>
                                <!-- Create a hidden field which is combined by 3 fields above -->
                                <input type="hidden" name="otp" />
                            </div>
                            <button class="btn btn-primary w-100 mb-3 submitOtp">
                                Verify my account
                            </button>
                            <div class="text-center">Didn't get the code?
                                <a id="resendOtp" href="javascript:void(0);">
                                    Resend
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- / Two Steps Verification -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const otpFields = $('.numeral-mask');

        otpFields.on('input', function () {
            const currentInput = $(this);
            const currentVal = currentInput.val();

            if (currentVal) {
                currentInput.next('.numeral-mask').focus();
            }
            updateHiddenField();
        });

        otpFields.on('keydown', function (e) {
            const currentInput = $(this);

            if (e.key === "Backspace" && currentInput.val() === '') {
                currentInput.prev('.numeral-mask').focus();
            }
        });

        function updateHiddenField() {
            let otpCode = '';
            otpFields.each(function () {
                otpCode += $(this).val();
            });
            $('input[name="otp"]').val(otpCode);
        }

        let email = $('#userEmail').text();
        let emailParts = email.split('@');
        let localPart = emailParts[0];
        let domainPart = emailParts[1];
        let redactedLocalPart = localPart.substring(0, 3) + '*****' + localPart.slice(-2);
        let redactedEmail = redactedLocalPart + '@' + domainPart;
        $('#userEmail').text(redactedEmail);

    </script>
    <script type="text/javascript" src="{{asset('assets/master_ui/js/wallet/wallet.js')}}"></script>
@endsection
