$(document).ready(function() {
    // Update/reset user image of account page
    let accountUserImage = $('#uploadedAvatar');
    let fileInput = $('.account-file-input');
    let resetFileInput = $('.account-image-reset');

    if (accountUserImage.length > 0) {
        const resetImage = accountUserImage.attr('src');

        fileInput.on('change', function() {
            if (this.files && this.files[0]) {
                accountUserImage.attr('src', URL.createObjectURL(this.files[0]));
            }
        });

        resetFileInput.on('click', function() {
            fileInput.val('');
            accountUserImage.attr('src', resetImage);
        });
    }

    $('.copy-link-btn').click(function(e) {
        e.preventDefault(); // Prevents the default action of opening the link
        var linkToCopy = $(this).data('link'); // Get the link from data attribute

        // Copy the link to the clipboard
        navigator.clipboard.writeText(linkToCopy).then(function() {
            showToast('Link copied to clipboard!', 'Success', 'bg-success'); // Show success message
        }).catch(function(error) {
            showToast('Failed to copy the link. Please try again.', 'Error', 'bg-danger');
        });
    });
});

function showToast(message, header, type, icon= 'bx bx-bell') {
    $('.toast-body').text(message);
    $('.toast-header').empty()
    $('.toast-header').append('<i class="'+icon+' me-2"></i><div class="me-auto fw-medium">'+header+'</div><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>');
    $('#dynamic-toast').removeClass('bg-danger bg-primary bg-success bg-warning bg-info');
    $('#dynamic-toast').addClass(type);
    $('#dynamic-toast').toast('show');
}

function copyToClipboard(elementId) {
    var copyText = document.getElementById(elementId).value;  // Get the value of the input field
    var tempTextarea = document.createElement("textarea");   // Create a temporary textarea element
    tempTextarea.value = copyText;  // Set its value to the text you want to copy
    document.body.appendChild(tempTextarea);  // Append it to the document
    tempTextarea.select();  // Select the text
    tempTextarea.setSelectionRange(0, 99999);  // For mobile devices
    document.execCommand("copy");  // Copy the text to clipboard
    document.body.removeChild(tempTextarea);  // Remove the textarea
    showToast("Copied the text", 'Success', 'bg-success');
}

function loadCustomer(){
    if ($('#customerSelector').length) {
        $('#customerSelector').on('change', function () {
            let cusId = $(this).val();
            $.ajax({
                url: "/customer/" + cusId,
                type: 'GET',
                success: function (response) {
                    $('#cus_name').val(response.name);
                    $('#cus_email').val(response.email);
                    $('#cus_tel_no').val(response.user_detail.tel_no);
                    console.log(response.email)
                },
                error: function (xhr) {
                    console.log(xhr)
                }
            });
        });
    }
}

function showServerErrors(xhr){
    if (xhr.status === 422) { // 422 is the status code for validation errors
        var response = xhr.responseJSON.errors;
        let delay = 0;
        console.log(xhr.responseJSON.errors)
        $.each(response, function (field, messages) {
            $.each(messages, function (index, message) {
                console.log(message)
                setTimeout(function () {
                    showToast(message, 'Error', 'bg-warning');
                }, delay);
                delay += 1000;

            });
        });
    }
}

function disableNextButton()
{
    let element = $('#customerSelector');
    let value = element.val();
    if (value) {
        $('#firstNext').attr('disabled', 'disabled');
    }

    $(element).on('change', function(){
        $('#firstNext').removeAttr('disabled')
    })
}
