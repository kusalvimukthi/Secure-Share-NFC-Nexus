$(document).ready(function () {

    loadCustomer();
    disableNextButton();

    //disable status update button initially
    $('.update-account-status').prop('disabled', true);

    // Monitor checkbox change event
    $('.walletCardStatus').on('change', function() {
        // Check if the checkbox is checked
        if ($(this).prop('checked')) {
            // Enable the button
            $('.update-account-status').prop('disabled', false);
        } else {
            // Disable the button
            $('.update-account-status').prop('disabled', true);
        }
    });

    $('#lastStep').on('click', function () {

        let richEditorContent = quillEditor.root.innerHTML;

        $('#preview_cus_id').text($('#customerSelector').val());
        $('#preview_name').text($('#cus_name').val());
        $('#preview_email').text($('#cus_email').val());
        $('#preview_tel_no').text($('#cus_tel_no').val());
        $('#richEditorContent').text('');
        $('#richEditorContent').append(richEditorContent);
        $('#extraNote').text($('#extra_note').val());

        $('#url_preview').text('');
        $('input[id^="url-"]').each(function () {
            let urlValue = $(this).val();
            $('#url_preview').append('<label class="form-label" for="form-repeater-3-5">URL</label><input type="text" id="form-repeater-3-5" class="form-control" value="' + urlValue + '">');
        });

        $('#username_preview').text('');
        $('input[id^="username-"]').each(function () {
            let userNameValue = $(this).val();
            $('#username_preview').append('<label class="form-label" for="form-repeater-3-5">User Name</label><input type="text" id="form-repeater-3-5" class="form-control" value="' + userNameValue + '">');
        });

        $('#password_preview').text('');
        $('input[id^="password-"]').each(function () {
            let passwordValue = $(this).val();
            $('#password_preview').append('<label class="form-label" for="basic-default-password32">Password</label><div class="input-group input-group-merge"><input type="password" class="form-control" value="' + passwordValue + '" aria-describedby="basic-default-password"><span class="input-group-text cursor-pointer" ><i class="bx bx-hide"></i></span></div>');
        });
    })


    $('#createWalletForm').on('submit', function (e) {
        e.preventDefault();

        let submitButton = $('.btn-submit');
        submitButton.prop('disabled', true);
        submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

        let passwordInput = 1;
        let userNameInput = 1;
        let urlInput = 1;
        let formData = new FormData(this);
        let token = $('meta[name="csrf-token"]').attr('content');
        let userId = $('#customerSelector').val();
        let richEditorContent = quillEditor.root.innerHTML;

        formData.append('user_id', userId);
        formData.append('_token', token);
        formData.append('editor_data', richEditorContent);

        //append dynamically added username,url and password fields to the form data
        appendCredentialData(formData, passwordInput, userNameInput, urlInput);


        $.ajax({
            url: '/wallet-create',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#createWalletForm')[0].reset();
                showToast('Wallet successfully created', 'Success', 'bg-success');
                submitButton.prop('disabled', false);
                submitButton.html('Submit');
                setTimeout(function() {
                    location.replace('/wallets-list');
                }, 2000);
            },
            error: function (xhr, status, error) {
                showServerErrors(xhr);

                submitButton.prop('disabled', false);
                submitButton.html('Submit');
            }
        });
    });

    $('#updateWalletForm').on('submit', function (e) {
        e.preventDefault();

        // Show confirmation dialog before submitting the wallet update
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update the wallet details?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel!',
            customClass: {
                confirmButton: 'btn btn-primary me-3',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with form submission if confirmed
                let submitButton = $('.btn-submit');
                submitButton.prop('disabled', true);
                submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

                let passwordInput = 1;
                let userNameInput = 1;
                let urlInput = 1;
                let formData = new FormData(this);
                let token = $('meta[name="csrf-token"]').attr('content');
                let walletId = $('#wallet_id').val();
                let richEditorContent = quillEditor.root.innerHTML;

                formData.append('wallet_id', walletId);
                formData.append('_token', token);
                formData.append('editor_data', richEditorContent);

                // Append dynamically added username, url, and password fields to the form data
                appendCredentialData(formData, passwordInput, userNameInput, urlInput);

                $.ajax({
                    url: '/wallet-update',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // Reset the form
                        $('#updateWalletForm')[0].reset();

                        // Show success toast
                        showToast('Wallet successfully updated', 'Success', 'bg-success');

                        // Re-enable the submit button and reset text
                        submitButton.prop('disabled', false);
                        submitButton.html('Submit');

                        // Show success Swal.fire message
                        Swal.fire({
                            icon: 'success',
                            title: 'Wallet Updated',
                            text: 'Your wallet has been successfully updated!',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        });

                        // Redirect after 2 seconds
                        setTimeout(function () {
                            location.replace('/wallet/' + walletId);
                        }, 2000);
                    },
                    error: function (xhr, status, error) {
                        // Show server-side errors
                        showServerErrors(xhr);

                        // Re-enable the submit button and reset text
                        submitButton.prop('disabled', false);
                        submitButton.html('Submit');

                        // Show error Swal.fire message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while updating the wallet. Please try again.',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });
                    }
                });
            }
        });
    });

    function appendCredentialData(formData, passwordInput, userNameInput, urlInput) {
        $('input[id^="password-"]').each(function () {
            if (passwordInput !== 1) {
                formData.append('password-' + passwordInput, $(this).val());
            }

            passwordInput++;
        });

        $('input[id^="username-"]').each(function () {
            if (userNameInput !== 1) {
                formData.append('username-' + userNameInput, $(this).val());
            }

            userNameInput++;
        });

        $('input[id^="url-"]').each(function () {
            if (urlInput !== 1) {
                formData.append('url-' + urlInput, $(this).val());
            }

            urlInput++;
        });
    }
})

//update card status
$('.walletCardStatusUpdateForm').on('submit', function (e) {
    e.preventDefault();

    // Disable the submit button and add a spinner
    let submitButton = $('.update-account-status');
    let btnText = 'Deactivate Account';
    submitButton.prop('disabled', true);
    submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

    let formData = new FormData(this);
    let token = $('meta[name="csrf-token"]').attr('content');
    formData.append('_token', token);

    let isChecked = $('.walletCardStatus').prop('checked');
    let updateType = $('#update_type').val();
    let status = true;
    if(updateType === 'activate') {
        if (isChecked) {
            status = true;
            btnText = 'Deactivate Account';
        }
    } else {
        if (isChecked) {
            status = false;
            btnText = 'Activate Account';
        }
    }

    formData.append('status', status);

    $.ajax({
        url: '/wallet-disable',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('.walletCardStatusUpdateForm')[0].reset();
            showToast('Custom card status changed', 'Success', 'bg-success');
            submitButton.prop('disabled', false);
            submitButton.html(btnText);
            setTimeout(function() {
                location.replace('/wallets-list');
            }, 2000);
        },
        error: function (xhr, status, error) {
            showServerErrors(xhr);

            // Re-enable the submit button and restore the original text
            submitButton.prop('disabled', true);
            submitButton.html(btnText);
        }
    });

});

//verify otp on wallet guest view
$('#verifyOtpForm').on('submit', function (e) {
    e.preventDefault();

    // Disable the submit button and add a spinner
    let submitButton = $('.submitOtp');
    submitButton.prop('disabled', true);
    submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

    let formData = new FormData(this);
    let token = $('meta[name="csrf-token"]').attr('content');
    formData.append('_token', token);

    $.ajax({
        url: '/verify-otp',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            location.replace(response.url);
        },
        error: function (xhr, status, error) {
            showServerErrors(xhr);
            submitButton.prop('disabled', false);
            submitButton.html('Verify My Account');
        }
    });
});

//resend otp
$('#resendOtp').on('click', function (e){
    e.preventDefault();

    let resendButton = $(this);
    resendButton.prop('disabled', true);
    resendButton.text('Resending...');

    $.ajax({
        url: '/resend-otp',
        type: 'GET',
        contentType: false,
        processData: false,
        success: function (response) {
            showToast(response.message, 'Success', 'bg-success');

            resendButton.prop('disabled', false);
            resendButton.text('Resend');
        },
        error: function (xhr, status, error) {
            showServerErrors(xhr);

            resendButton.prop('disabled', false);
            resendButton.text('Resend');
        }
    });
});
