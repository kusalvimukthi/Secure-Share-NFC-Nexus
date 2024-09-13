$('#formAuthentication').on('submit', function (e) {
    e.preventDefault();

    if ($(this).valid()) {
        let formData = new FormData(this);
        let token = $('meta[name="csrf-token"]').attr('content');
        formData.append('_token', token);

        // Disable the button and show the spinner
        let loginButton = $('#loginButton');
        let loginSpinner = $('#loginSpinner');
        loginButton.prop('disabled', true).addClass('disabled');
        loginSpinner.show();

        $.ajax({
            url: '/login',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                window.location.href = '/dashboard';
            },
            error: function (xhr, status, error) {
                let errorMessage = '<p>Something went wrong. Please try again.</p>';
                if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.email) {
                    errorMessage = '<p>' + xhr.responseJSON.errors.email[0] + '</p>';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = '<p>' + xhr.responseJSON.message + '</p>';
                }

                $('#message').html(errorMessage);

                // Re-enable the button and hide the spinner
                loginButton.prop('disabled', false).removeClass('disabled');
                loginSpinner.hide();
            }
        });
    }
});

//set new password
// $('#setNewPassword').on('submit', function (e){
//     e.preventDefault();
//     if ($(this).valid()){
//         let formData = new FormData(this);
//         let token = $('meta[name="csrf-token"]').attr('content');
//         formData.append('_token', token);
//
//         $.ajax({
//             url: '/set-password',
//             type: 'POST',
//             data: formData,
//             contentType: false,
//             processData: false,
//             success: function(response) {
//                 console.log(response);
//                 if(response.status) {
//                     window.location.href = response.url;
//                 }
//             },
//             error: function(xhr, status, error) {
//                 if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.email) {
//                     $('#message').html('<p>' + xhr.responseJSON.errors.email[0] + '</p>');
//                 } else if (xhr.responseJSON && xhr.responseJSON.message) {
//                     $('#message').html('<p>' + xhr.responseJSON.message + '</p>');
//                 } else {
//                     $('#message').html('<p>' + xhr.status + ': ' + xhr.statusText + '</p>');
//                 }
//             }
//         });
//     }
// })


$('#password').on('input', function() {
    let password = $(this).val();
    let userName = $('#user-name').val(); // Assuming you have an input field with the user's name

    if(password.length > 0) {
        $.ajax({
            url: 'http://localhost:5000/predict_password_strength',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                password: password,
                user_name: userName
            }),
            success: function(response) {
                let score = response.score;
                let feedback = response.feedback;

                let message = "Password strength: ";
                let color = ""; // Variable to hold the color

                switch(score) {
                    case 0:
                        message += "Very Weak";
                        color = "red";
                        break;
                    case 1:
                        message += "Weak";
                        color = "red";
                        break;
                    case 2:
                        message += "Fair";
                        color = "orange";
                        break;
                    case 3:
                        message += "Good";
                        color = "green";
                        break;
                    case 4:
                        message += "Strong";
                        color = "green";
                        break;
                }

                if (feedback.length > 0) {
                    message += ".<br>Suggestions: " + feedback.join("<br>");
                }

                // Apply the color to the message
                $('#password-strength').html('<p style="color:' + color + ';">' + message + '</p>');
            },
            error: function(xhr, status, error) {
                $('#password-strength').html('');
            }
        });
    } else {
        $('#password-strength').html('');
    }
});


$('#setNewPassword').on('submit', function (e) {
    e.preventDefault();
    if ($(this).valid()){
        let formData = new FormData(this);
        let token = $('meta[name="csrf-token"]').attr('content');
        formData.append('_token', token);

        $.ajax({
            url: '/set-password',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                if(response.status) {
                    window.location.href = response.url;
                }
            },
            error: function(xhr, status, error) {
                if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.email) {
                    $('#message').html('<p>' + xhr.responseJSON.errors.email[0] + '</p>');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    $('#message').html('<p>' + xhr.responseJSON.message + '</p>');
                } else {
                    $('#message').html('<p>' + xhr.status + ': ' + xhr.statusText + '</p>');
                }
            }
        });
    }
});
