let eC, sC = $("#users-table"), oC = $(".select2"), iC = "app-user-view-account.html", rS = {
    1: {
        title: "Pending",
        class: "bg-label-warning"
    },
    2: {
        title: "Active",
        class: "bg-label-success"
    },
    3: {
        title: "Inactive",
        class: "bg-label-secondary"
    }
};

$(document).ready(function() {
    //data table
    let customersTable =  new DataTable('#customers-table', {
        processing: true,
        serverSide: true,
        ajax: "/customers-data",
        columns: [
            {
                data: null,
            },
            {data: 'id'},
            {data: 'email'},
            {data: 'nic'},
            {data: 'status'},
            {data: 'action'}
        ],
        columnDefs: [
            {
                targets: 0,
                orderable: !1,
                checkboxes: {
                    selectAllRender: '<input type="checkbox" class="form-check-input">'
                },
                render: function () {
                    return '<input type="checkbox" class="dt-checkboxes form-check-input" >'
                },
                searchable: !1
            },
        ],
    });

    $('#resendEmail').on('click', function (e) {
        e.preventDefault();

        let resendButton = $(this);
        resendButton.prop('disabled', true).text('Resending...');

        $.ajax({
            url: "/resend-verification",
            type: 'GET',
            success: function(response) {
                showToast('Verification email sent successfully. Please check your inbox', 'Success', 'bg-success');
                setTimeout(function() {
                    resendButton.prop('disabled', false).text('Resend');
                }, 5000);
            },
            error: function(xhr) {
                console.log(xhr);
                showToast('Please correct the errors in the form', 'Error', 'bg-danger');
                resendButton.prop('disabled', false).text('Resend');
            }
        });
    });


    $('#forgotPasswordForm').on('submit', function (e) {
        e.preventDefault();

        let submitButton = $(this).find('button[type="submit"]');
        let spinner = $('#spinner');

        // Disable button and show spinner
        submitButton.prop('disabled', true).addClass('disabled');
        spinner.show();

        if ($(this).valid()) {
            let formData = new FormData(this);
            let token = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', token);

            $.ajax({
                url: "/forgot-password",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // Show success toast
                    showToast('Email sent successfully. Please check your inbox.', 'Success', 'bg-success');

                    // Re-enable button and hide spinner
                    submitButton.prop('disabled', false).removeClass('disabled');
                    spinner.hide();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function (key, value) {
                            let errorElement = $('#error-' + key);
                            errorElement.text(value[0]);

                            let inputElement = $('#' + key);
                            inputElement.addClass('is-invalid');
                        });

                        // Show validation error toast
                        showToast('Please correct the errors in the form.', 'Error', 'bg-danger');
                    } else {
                        // Show general error toast
                        showToast('Something went wrong. Please try again.', 'Error', 'bg-danger');
                    }

                    // Re-enable button and hide spinner on error
                    submitButton.prop('disabled', false).removeClass('disabled');
                    spinner.hide();
                }
            });
        } else {
            // Re-enable button and hide spinner if form is not valid
            submitButton.prop('disabled', false).removeClass('disabled');
            spinner.hide();
        }
    });



    $('#passwordResetForm').on('submit', function (e) {
        e.preventDefault();

        let submitButton = $('#resetPasswordButton');
        let spinner = $('#resetSpinner');

        // Disable the button and show the spinner
        submitButton.prop('disabled', true).addClass('disabled');
        spinner.show();

        if ($(this).valid()) {
            let formData = new FormData(this);
            let token = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', token);

            $.ajax({
                url: "/reset-password",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    showToast('Password successfully changed', 'Success', 'bg-success');
                    window.location.href = '/login';
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            let errorElement = $('#error-' + key);
                            errorElement.text(value[0]);
                            let inputElement = $('#' + key);
                            inputElement.addClass('is-invalid');
                        });
                    } else {
                        showToast('Something went wrong. Please try again', 'Error', 'bg-danger');
                    }

                    // Re-enable the button and hide the spinner on error
                    submitButton.prop('disabled', false).removeClass('disabled');
                    spinner.hide();
                }
            });
        } else {
            // Re-enable the button and hide the spinner if form is not valid
            submitButton.prop('disabled', false).removeClass('disabled');
            spinner.hide();
        }
    });
})
