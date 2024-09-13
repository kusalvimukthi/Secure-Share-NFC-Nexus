$('#formAccountSettings').on('submit', function (e) {
    e.preventDefault();

    // Show confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to update your profile?",
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
            if ($(this).valid()) {
                let formData = new FormData(this);
                let token = $('meta[name="csrf-token"]').attr('content');
                formData.append('_token', token);

                // Disable button, show spinner
                let submitButton = $(this).find('button[type="submit"]');
                let spinner = $('#spinner');
                submitButton.prop('disabled', true).addClass('disabled');
                spinner.show();

                $.ajax({
                    url: '/update_user',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#formAccountSettings')[0].reset();

                        // Show success toast
                        showToast('User successfully updated!', 'Success', 'bg-success');

                        // Re-enable button, hide spinner
                        submitButton.prop('disabled', false).removeClass('disabled');
                        spinner.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'User updated',
                            text: 'User successfully updated!',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        }).then(() => {
                            location.replace(response.redirect_url)
                        });
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function (key, value) {
                                let errorElement = $('#error-' + key);
                                errorElement.text(value[0]);

                                let inputElement = $('#' + key);
                                inputElement.addClass('is-invalid');
                            });

                            // Show validation error toast
                            showToast('Please correct the errors and try again.', 'Error', 'bg-danger');

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: 'Please correct the errors and try again.',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                },
                                buttonsStyling: false
                            });
                        } else {
                            // Show general error toast
                            showToast('Something went wrong! Please try again later.', 'Error', 'bg-danger');

                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Something went wrong! Please try again later.',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                },
                                buttonsStyling: false
                            });
                        }

                        // Re-enable button, hide spinner
                        submitButton.prop('disabled', false).removeClass('disabled');
                        spinner.hide();
                    }
                });
            }
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Handle the cancel action
            Swal.fire({
                title: 'Cancelled',
                text: 'Your profile update was cancelled.',
                icon: 'info',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        }
    });
});

$('#formAccountPassword').on('submit', function (e) {
    e.preventDefault();

    if ($(this).valid()) {
        // Show confirmation dialog before updating the password
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to update your password?",
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
                let formData = new FormData(this);
                let token = $('meta[name="csrf-token"]').attr('content');
                formData.append('_token', token);

                // Disable button and show spinner
                let submitButton = $(this).find('button[type="submit"]');
                let spinner = $('#spinner');
                submitButton.prop('disabled', true).addClass('disabled');
                spinner.show();

                $.ajax({
                    url: '/change-password',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#formAccountPassword')[0].reset();

                        // Show success toast
                        showToast('Your password has been successfully updated!', 'Success', 'bg-success');

                        // Re-enable button and hide spinner
                        submitButton.prop('disabled', false).removeClass('disabled');
                        spinner.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Password Updated',
                            text: 'Your password has been successfully updated!',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        });
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function (key, value) {
                                let errorElement = $('#error-' + key);
                                errorElement.text(value[0]);

                                let inputElement = $('#' + key);
                                inputElement.addClass('is-invalid');
                            });

                            // Show validation error toast
                            showToast('Please correct the errors and try again.', 'Error', 'bg-danger');

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: 'Please correct the errors and try again.',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                },
                                buttonsStyling: false
                            });
                        } else {
                            // Show general error toast
                            showToast('Something went wrong! Please try again later.', 'Error', 'bg-danger');

                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Something went wrong! Please try again later.',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                },
                                buttonsStyling: false
                            });
                        }

                        // Re-enable button and hide spinner
                        submitButton.prop('disabled', false).removeClass('disabled');
                        spinner.hide();
                    }
                });

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'Your password update was cancelled.',
                    icon: 'info',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }
        });
    }
});



