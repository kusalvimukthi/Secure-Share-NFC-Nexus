$(document).ready(function (){
    loadCustomer();
    disableNextButton();

    //disable status update button initially
    $('.update-account-status').prop('disabled', true);

    // Monitor checkbox change event
    $('.petCardStatus').on('change', function() {
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

        $('#owner_name_preview').text($('#name').val());
        $('#owner_tel_no_preview').text($('#tel_no').val());
        $('#owner_email_preview').text($('#email').val());
        $('#owner_address_preview').text($('#address').val());

        $('#pet_name_preview').text($('#pet_name').val());
        $('#bio_preview').text($('#bio').val());
        $('#preview_photo').text($('#upload').val());
        $('#dob_preview').text($('#date_of_birth').val());

        let tableBody = $('#table_body');
        // Object to store grouped inputs by index
        let data = {};

        // Collect all the vaccine values with their indices
        $('input[id^="vaccine_"]').each(function() {
            let id = $(this).attr('id');
            let index = id.split('_').pop(); // Get the last part of the ID
            data[index] = data[index] || {};
            data[index]['vaccine'] = $(this).val();
        });

        // Collect all the vaccination dates with their indices
        $('input[id^="vaccination_date_"]').each(function() {
            let id = $(this).attr('id');
            let index = id.split('_').pop(); // Get the last part of the ID
            data[index] = data[index] || {};
            data[index]['vaccinationDate'] = $(this).val();
        });

        // Collect all the next vaccination dates with their indices
        $('input[id^="next_vaccination_date_"]').each(function() {
            let id = $(this).attr('id');
            let index = id.split('_').pop(); // Get the last part of the ID
            data[index] = data[index] || {};
            data[index]['nextVaccinationDate'] = $(this).val();
        });

        // Now iterate over the data object and add rows to the table
        tableBody.text('');
        $.each(data, function(index, values) {
            if (values.vaccine && values.vaccinationDate && values.nextVaccinationDate) {
                let newRow = `
                <tr>
                    <td>${values.vaccine}</td>
                    <td>${values.vaccinationDate}</td>
                    <td>${values.nextVaccinationDate}</td>
                </tr>
            `;
                tableBody.append(newRow);
            }
        });
    })

    $('#petCardCreateForm').on('submit', function (e) {
        e.preventDefault();


        let vaccineInput = 1;
        let vaccinationDateInput = 1;
        let nextVaccinationDateInput = 1;
        let formData = new FormData(this);
        let token = $('meta[name="csrf-token"]').attr('content');
        let userId = $('#customerSelector').val();
        let submitButton = $('.btn-submit');
        submitButton.prop('disabled', true);
        submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

        formData.append('user_id', userId);
        formData.append('_token', token);
        appendVaccinationData(formData, vaccineInput, vaccinationDateInput, nextVaccinationDateInput);

        $.ajax({
            url: '/create-pet-tag',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#petCardCreateForm')[0].reset();
                showToast('Pet Tag successfully created', 'Success', 'bg-success');
                submitButton.prop('disabled', false);
                submitButton.html('Submit');
                setTimeout(function() {
                    location.replace('/pet-tags-list');
                }, 2000);
            },
            error: function (xhr, status, error) {
                showServerErrors(xhr);
                submitButton.prop('disabled', false);
                submitButton.html('Submit');
            }
        });
    })

    $('#petCardUpdateForm').on('submit', function (e) {
        e.preventDefault();

        // Show confirmation dialog before updating the pet card
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update the pet tag?",
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

                let card_id = $('#pet_tag_id').val();
                let vaccineInput = 1;
                let vaccinationDateInput = 1;
                let nextVaccinationDateInput = 1;
                let formData = new FormData(this);
                let token = $('meta[name="csrf-token"]').attr('content');
                let submitButton = $('.btn-submit');

                // Disable the submit button and show spinner
                submitButton.prop('disabled', true);
                submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

                formData.append('_token', token);
                appendVaccinationData(formData, vaccineInput, vaccinationDateInput, nextVaccinationDateInput);

                $.ajax({
                    url: '/pet-tag-update',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // Reset the form
                        $('#petCardUpdateForm')[0].reset();

                        // Show success toast
                        showToast('Pet Tag successfully updated', 'Success', 'bg-success');

                        // Re-enable the submit button and reset text
                        submitButton.prop('disabled', false);
                        submitButton.html('Submit');

                        // Show success Swal.fire message
                        Swal.fire({
                            icon: 'success',
                            title: 'Pet Tag Updated',
                            text: 'Your pet tag has been successfully updated!',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        });

                        // Redirect after 2 seconds
                        setTimeout(function () {
                            location.replace('/pet-tag/' + card_id);
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
                            text: 'An error occurred while updating the pet tag. Please try again.',
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

    function appendVaccinationData(formData, vaccineInput, vaccinationDateInput, nextVaccinationDateInput) {

        $('input[id^="vaccine_"]').each(function () {
            formData.append('vaccine_' + vaccineInput, $(this).val());
            vaccineInput++;
        });

        $('input[id^="vaccination_date_"]').each(function () {
            formData.append('vaccination_date_' + vaccinationDateInput, $(this).val());
            vaccinationDateInput++;
        });

        $('input[id^="next_vaccination_date_"]').each(function () {
            formData.append('next_vaccination_date_' + nextVaccinationDateInput, $(this).val());
            nextVaccinationDateInput++;
        });
    }
})

//update card status
$('.petCardStatusUpdateForm').on('submit', function (e) {
    e.preventDefault();

    // Disable the submit button and add a spinner
    let submitButton = $('.update-account-status');
    let btnText = 'Deactivate Account';
    submitButton.prop('disabled', true);
    submitButton.html('<span class="spinner-grow me-1" role="status" aria-hidden="true"></span> Loading...');

    let formData = new FormData(this);
    let token = $('meta[name="csrf-token"]').attr('content');
    formData.append('_token', token);

    let isChecked = $('.petCardStatus').prop('checked');
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
        url: '/pet-tag-disable',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('.petCardStatusUpdateForm')[0].reset();
            showToast('Custom card status changed', 'Success', 'bg-success');
            submitButton.prop('disabled', false);
            submitButton.html(btnText);
            setTimeout(function() {
                location.replace('/pet-tags-list');
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
