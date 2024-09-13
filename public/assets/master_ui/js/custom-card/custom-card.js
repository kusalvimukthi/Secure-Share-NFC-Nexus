$(document).ready(function () {

    loadCustomer();
    disableNextButton();

    //disable status update button initially
    $('.update-account-status').prop('disabled', true);

    // Monitor checkbox change event
    $('.customCardStatus').on('change', function() {
        // Check if the checkbox is checked
        if ($(this).prop('checked')) {
            // Enable the button
            $('.update-account-status').prop('disabled', false);
        } else {
            // Disable the button
            $('.update-account-status').prop('disabled', true);
        }
    });

    $('#personalInfoNext').on('click', function () {

        $('#preview_cus_id').text($('#customerSelector').val());
        $('#preview_name').text($('#cus_name').val());
        $('#preview_email').text($('#cus_email').val());
        $('#preview_tel_no').text($('#cus_tel_no').val());
        $('#preview_url').text($('#url').val());
    })


    $('#customCardCreateForm').on('submit', function (e) {

        e.preventDefault();

        let formData = new FormData(this);
        let token = $('meta[name="csrf-token"]').attr('content');
        let userId = $('#customerSelector').val();
        let submitButton = $('.btn-submit');
        submitButton.prop('disabled', true);
        submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

        formData.append('user_id', userId);
        formData.append('_token', token);


        $.ajax({
            url: '/create-custom-card',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#customCardCreateForm')[0].reset();
                showToast('Custom Card successfully Created', 'Success', 'bg-success');
                submitButton.prop('disabled', false);
                submitButton.html('Submit');
                setTimeout(function() {
                    location.replace('/custom-cards-list');
                }, 2000);
            },
            error: function (xhr, status, error) {
                showServerErrors(xhr);
                submitButton.prop('disabled', false);
                submitButton.html('Submit');
            }
        });
    });

    $('#customCardUpdateForm').on('submit', function (e) {
        e.preventDefault();

        // Show confirmation dialog before updating the custom card
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update the custom card?",
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
                let submitButton = $('.btn-submit');

                // Disable the submit button and show spinner
                submitButton.prop('disabled', true);
                submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

                formData.append('_token', token);
                let card_id = $('#card_id').val();

                $.ajax({
                    url: '/custom-card-update',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // Reset the form
                        $('#customCardUpdateForm')[0].reset();
                        showToast('Custom Card successfully Updated', 'Success', 'bg-success');

                        // Re-enable the submit button and reset text
                        submitButton.prop('disabled', false);
                        submitButton.html('Submit');

                        // Show success Swal.fire message
                        Swal.fire({
                            icon: 'success',
                            title: 'Custom Card Updated',
                            text: 'Your custom card has been successfully updated!',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        });

                        // Redirect after 2 seconds
                        setTimeout(function () {
                            location.replace('/custom-card/' + card_id);
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
                            text: 'An error occurred while updating the custom card. Please try again.',
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


    // $('#custom-card-copy').on('click', function(e) {
    //     e.preventDefault();
    //     let href = $(this).attr('href');
    //     navigator.clipboard.writeText(href).then(function() {
    //         alert('Link copied to clipboard: ' + href);
    //     }).catch(function(err) {
    //         console.error('Failed to copy: ', err);
    //     });
    // });
})



//update card status
$('.customCardStatusUpdateForm').on('submit', function (e) {
    e.preventDefault();

    // Disable the submit button and add a spinner
    let submitButton = $('.update-account-status');
    let btnText = 'Deactivate Account';
    submitButton.prop('disabled', true);
    submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

    let formData = new FormData(this);
    let token = $('meta[name="csrf-token"]').attr('content');
    formData.append('_token', token);

    let isChecked = $('.customCardStatus').prop('checked');
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
        url: '/custom-card-disable',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('.customCardStatusUpdateForm')[0].reset();
            showToast('Custom card status changed', 'Success', 'bg-success');
            submitButton.prop('disabled', false);
            submitButton.html(btnText);
            setTimeout(function() {
                location.replace('/custom-cards-list');
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
