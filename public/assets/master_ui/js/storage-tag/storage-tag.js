$(document).ready(function (){
    loadCustomer();

    //disable status update button initially
    $('.update-account-status').prop('disabled', true);

    // Monitor checkbox change event
    $('.storageCardStatus').on('change', function() {
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

        $('#product_name_preview').text($('#product').val());
        $('#product_weight_preview').text($('#pweight').val());
        $('#product_details_preview').text($('#pdetails').val());
        $('#storage_manufactured_date_preview').text($('#mnfdate').val());
        $('#expiration_date_preview').text($('#exdate').val());
    })

    $('#storageCardCreateForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let token = $('meta[name="csrf-token"]').attr('content');
        let userId = $('#customerSelector').val();
        formData.append('user_id', userId);
        formData.append('_token', token);

        $.ajax({
            url: '/create-storage-tag',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#storageCardCreateForm')[0].reset();
                showToast('Storage Tag Successfully Created', 'Success', 'bg-success');
                setTimeout(function() {
                    location.replace('/storage-tags-list');
                }, 2000);
            },
            error: function (xhr, status, error) {
                showServerErrors(xhr);
            }
        });
    })

    $('#storageCardUpdateForm').on('submit', function (e) {
        e.preventDefault();

        // Show confirmation dialog before updating the storage tag
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update the storage tag?",
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
                let card_id = $('#storage_tag_id').val();
                let formData = new FormData(this);
                let token = $('meta[name="csrf-token"]').attr('content');
                formData.append('_token', token);
                let submitButton = $('.btn-submit');

                // Disable the submit button and show spinner
                submitButton.prop('disabled', true);
                submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

                $.ajax({
                    url: '/storage-tag-update',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // Reset the form
                        $('#storageCardUpdateForm')[0].reset();

                        // Show success toast
                        showToast('Storage Tag Successfully Updated', 'Success', 'bg-success');

                        // Re-enable the submit button and reset text
                        submitButton.prop('disabled', false);
                        submitButton.html('Submit');

                        // Show success Swal.fire message
                        Swal.fire({
                            icon: 'success',
                            title: 'Storage Tag Updated',
                            text: 'Your storage tag has been successfully updated!',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        });

                        // Redirect after 2 seconds
                        setTimeout(function () {
                            location.replace('/storage-tag/' + card_id);
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
                            text: 'An error occurred while updating the storage tag. Please try again.',
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
})

//update card status
$('.storageCardStatusUpdateForm').on('submit', function (e) {
    e.preventDefault();

    // Disable the submit button and add a spinner
    let submitButton = $('.update-account-status');
    let btnText = 'Deactivate Account';
    submitButton.prop('disabled', true);
    submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

    let formData = new FormData(this);
    let token = $('meta[name="csrf-token"]').attr('content');
    formData.append('_token', token);

    let isChecked = $('.storageCardStatus').prop('checked');
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
        url: '/storage-tag-disable',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('.storageCardStatusUpdateForm')[0].reset();
            showToast('Storage tag status changed', 'Success', 'bg-success');
            submitButton.prop('disabled', false);
            submitButton.html(btnText);
            setTimeout(function() {
                location.replace('/storage-tags-list');
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

