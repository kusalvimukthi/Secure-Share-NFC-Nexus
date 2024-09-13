$(document).ready(function () {
    loadCustomer();
    disableNextButton();

    //disable status update button initially
    $('.update-account-status').prop('disabled', true);

    // Monitor checkbox change event
    $('.businessCardStatus').on('change', function() {
        // Check if the checkbox is checked
        if ($(this).prop('checked')) {
            // Enable the button
            $('.update-account-status').prop('disabled', false);
        } else {
            // Disable the button
            $('.update-account-status').prop('disabled', true);
        }
    });

    $('#lastStep').on('click', function (){

        let file = $("#upload")[0].files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#imagePreview").attr("src", e.target.result).show();
            }
            reader.readAsDataURL(file);
        }

        $('#preview_cus_id').text($('#customerSelector').val());
        $('#preview_name').text($('#cus_name').val());
        $('#preview_email').text($('#cus_email').val());
        $('#preview_tel_no').text($('#cus_tel_no').val());
        $('#preview_business_card_name').text($('#name').val());
        $('#preview_card_tel_no').text($('#tel_no').val());
        $('#preview_business_card_email').text($('#email').val());
        $('#preview_address').text($('#address').val());
        $('#preview_company_name').text($('#company_name').val());
        $('#preview_designation').text($('#designation').val());
        $('#preview_photo').text($('#upload').val());
        $('#preview_bio').text($('#bio').val());
        $('#preview_website_link').text($('#web-link').val());
        $('#preview_portfolio_link').text($('#Portfolio').val());
        $('#preview_twitter_link').text($('#twitter').val());
        $('#preview_facebook_link').text($('#facebook').val());
        $('#preview_linkedin_link').text($('#linkedin').val());
        $('#preview_instagram_link').text($('#instagram').val());
    })


});

//create business card
$('#businessCardCreateForm').on('submit', function (e) {
    e.preventDefault();

    // Disable the submit button and add a spinner
    let submitButton = $('.btn-submit');
    submitButton.prop('disabled', true);
    submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

    let formData = new FormData(this);
    let token = $('meta[name="csrf-token"]').attr('content');
    let userId = $('#customerSelector').val();
    formData.append('user_id', userId);
    formData.append('_token', token);

    $.ajax({
        url: '/business-card-create',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#businessCardCreateForm')[0].reset();
            showToast('Business card created', 'Success', 'bg-success');
            submitButton.prop('disabled', false);
            submitButton.html('Submit');
            setTimeout(function() {
                location.replace('/cards-view');
            }, 2000);
        },
        error: function (xhr, status, error) {
            showServerErrors(xhr);

            // Re-enable the submit button and restore the original text
            submitButton.prop('disabled', false);
            submitButton.html('Submit');
        }
    });
});

//update business card
$('#businessCardUpdateForm').on('submit', function (e) {
    e.preventDefault();

    // Show confirmation dialog before updating the business card
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update the business card?",
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

            // Disable the submit button and show spinner
            let submitButton = $('.btn-submit');
            submitButton.prop('disabled', true);
            submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

            let formData = new FormData(this);
            let token = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', token);

            let fileInput = document.getElementById('upload');
            if (fileInput.files.length === 0) {
                formData.delete('businessCardAvatar');
            }
            let card_id = $('#card_id').val();

            $.ajax({
                url: '/business-card-update',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // Reset the form
                    $('#businessCardUpdateForm')[0].reset();

                    // Show success toast
                    showToast('Business card updated', 'Success', 'bg-success');

                    // Re-enable the submit button and reset text
                    submitButton.prop('disabled', false);
                    submitButton.html('Submit');

                    // Show success Swal.fire message
                    Swal.fire({
                        icon: 'success',
                        title: 'Business Card Updated',
                        text: 'Your business card has been successfully updated!',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });

                    // Redirect after 2 seconds
                    setTimeout(function() {
                        location.replace('/business-card/' + card_id);
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
                        text: 'An error occurred while updating the business card. Please try again.',
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

//update card status
$('.businessCardStatusUpdateForm').on('submit', function (e) {
    e.preventDefault();

    // Disable the submit button and add a spinner
    let submitButton = $('.update-account-status');
    let btnText = 'Deactivate Account';
    submitButton.prop('disabled', true);
    submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

    let formData = new FormData(this);
    let token = $('meta[name="csrf-token"]').attr('content');
    formData.append('_token', token);

    let isChecked = $('.businessCardStatus').prop('checked');
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
        url: '/business-card-disable',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('.businessCardStatusUpdateForm')[0].reset();
            showToast('Business card status changed', 'Success', 'bg-success');
            submitButton.prop('disabled', false);
            submitButton.html(btnText);
            setTimeout(function() {
                location.replace('/cards-view');
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
