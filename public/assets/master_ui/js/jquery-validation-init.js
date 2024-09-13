$(document).ready(function() {
    $('#formAuthentication').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            }
        },
        ignore: ':hidden',
        errorClass: "invalid-feedback animated fadeInUp",
        errorElement: "div",
        errorPlacement: function(e, a) {
            jQuery(a).parents(".form-group").append(e)
        },
        highlight: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid"),
                jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid"), jQuery(e).remove()
        },
    });

    $('#create_customer').validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            tel_no: {
                required: true,
                phoneLK: true,
            },
            nic: {
                required: true
            },
            user_type: {
                required: true,
                min: 1 // Ensures that a valid option (not the "Select user type..." option) is chosen
            },
            address: {
                required: true
            },
            town: {
                required: true
            },
            state: {
                required: true
            },
            post_code: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            tel_no: {
                required: "Please enter your telephone number",
                phoneLK: "Please enter a valid Sri Lankan phone number",
            },
            nic: {
                required: "Please enter your NIC number"
            },
            user_type: {
                required: "Please select a user type",
                min: "Please select a valid user type" // Custom message for invalid selection
            },
            address: {
                required: "Please enter your address"
            },
            town: {
                required: "Please enter your town"
            },
            state: {
                required: "Please enter your state"
            },
            post_code: {
                required: "Please enter your post code"
            }
        },
        ignore: ':hidden',
        errorClass: "invalid-feedback animated fadeInUp",
        errorElement: "div",
        errorPlacement: function(e, a) {
            jQuery(a).parents(".form-group").append(e)
        },
        highlight: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid"),
                jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid"), jQuery(e).remove()
        },
    });

    $('#setNewPassword').validate({
        rules: {
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                required: "Please enter a password.",
                minlength: "Your password must be at least 8 characters long."
            },
            password_confirmation: {
                required: "Please confirm your password.",
                equalTo: "Passwords do not match."
            }
        },
        errorClass: "invalid-feedback animated fadeInUp",
        errorElement: "div",
        errorPlacement: function (e, a) {
            jQuery(a).parents(".form-group").append(e)
        },
        highlight: function (e) {},
        success: function (e) {},
    });

    $('#formAccountSettings').validate({
        rules: {
            avatar: {
                required: true,
                extension: "jpg|jpeg|png|gif",
                filesize: 800000 // 800 KB in bytes
            },
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            tel_no: {
                required: true,
                phoneLK: true // Custom validation method
            }
        },
        messages: {
            avatar: {
                required: "Please upload an avatar image",
                extension: "Allowed file types are JPG, GIF, or PNG",
                filesize: "File size must be less than 800 KB"
            },
            name: {
                required: "Please enter your name",
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            tel_no: {
                required: "Please enter your telephone number",
                phoneLK: "Please enter a valid Sri Lankan phone number"
            }
        },
        ignore: ':hidden',
        errorClass: "invalid-feedback animated fadeInUp",
        errorElement: "div",
        errorPlacement: function(e, a) {
            jQuery(a).parents(".form-group").append(e)
        },
        highlight: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid"),
                jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid"), jQuery(e).remove()
        },
    });

    $.validator.addMethod("phoneLK", function(value, element) {
        return this.optional(element) || /^[1-9]\d{8}$/.test(value);
    }, "Please enter a valid Sri Lankan phone number");

    $.validator.addMethod("filesize", function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, "File size must be less than 800 KB");

    // $('#businessCardCreateForm').validate({
    //     rules: {
    //         cus_email: {
    //             required: true,
    //             email: true
    //         }
    //     },
    //     messages: {
    //         cus_email: {
    //             required: "Please enter your email",
    //             email: "Please enter valid email"
    //         }
    //     },
    //     ignore: ':hidden',
    //     errorClass: "invalid-feedback animated fadeInUp",
    //     errorElement: "div",
    //     errorPlacement: function(e, a) {
    //         jQuery(a).parents(".form-group").append(e)
    //     },
    //     highlight: function(e) {
    //         jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
    //         jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid").addClass("is-invalid")
    //     },
    //     success: function(e) {
    //         jQuery(e).closest(".form-group").removeClass("is-invalid")
    //         jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid")
    //         jQuery(e).remove()
    //     },
    // });
});

$('#formAccountPassword').validate({
    rules: {
        current_password: {
            required: true,
            minlength: 8
        },
        password: {
            required: true,
            minlength: 8
        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        }
    },
    messages: {
        current_password: {
            required: "Please enter your current password.",
            minlength: "Your password must be at least 8 characters long."
        },
        password: {
            required: "Please enter a password.",
            minlength: "Your password must be at least 8 characters long."
        },
        password_confirmation: {
            required: "Please confirm your password.",
            equalTo: "Passwords do not match."
        }
    },
    ignore: ':hidden',
    errorClass: "invalid-feedback animated fadeInUp",
    errorElement: "div",
    errorPlacement: function(e, a) {
        jQuery(a).parents(".form-group").append(e)
    },
    highlight: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid"),
            jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid").addClass("is-invalid")
    },
    success: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid"), jQuery(e).remove()
    },
});

$('#passwordResetForm').validate({
    rules: {
        password: {
            required: true,
            minlength: 8
        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        }
    },
    messages: {
        password: {
            required: "Please enter a password.",
            minlength: "Your password must be at least 8 characters long."
        },
        password_confirmation: {
            required: "Please confirm your password.",
            equalTo: "Passwords do not match."
        }
    },
    ignore: ':hidden',
    errorClass: "invalid-feedback animated fadeInUp",
    errorElement: "div",
    errorPlacement: function(e, a) {
        jQuery(a).parents(".form-group").append(e)
    },
    highlight: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid"),
            jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid").addClass("is-invalid")
    },
    success: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid"), jQuery(e).remove()
    },
});

$('#forgotPasswordForm').validate({
    rules: {
        email: {
            required: true,
            email: true
        }
    },
    messages: {
        email: {
            required: "Please enter your email",
            email: "Please enter valid email"
        }
    },
    ignore: ':hidden',
    errorClass: "invalid-feedback animated fadeInUp",
    errorElement: "div",
    errorPlacement: function(e, a) {
        jQuery(a).parents(".form-group").append(e)
    },
    highlight: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid"),
            jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid").addClass("is-invalid")
    },
    success: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).closest(".form-group").find('.form-control').removeClass("is-invalid"), jQuery(e).remove()
    },
});
