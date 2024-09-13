(function() {
    var s = document.querySelector("#wizard-validation");

    if (s !== null) {
        var l = s.querySelector("#customCardCreateForm");
        let e = l.querySelector("#step1"),
            d = l.querySelector("#step2"),
            m = l.querySelector("#step3"),
            uNextButtons = [].slice.call(l.querySelectorAll(".btn-next")),
            lPrevButtons = [].slice.call(l.querySelectorAll(".btn-prev"));

        let a = new Stepper(s, {
            linear: true
        });

        // Validation for Step 1
        let i = FormValidation.formValidation(e, {
            fields: {
                cus_name: {
                    validators: {
                        notEmpty: {
                            message: "The name is required"
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: "The name must be more than 3 and less than 30 characters long"
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: "The name can only consist of alphabetical characters and spaces"
                        }
                    }
                },
                cus_email: {
                    validators: {
                        notEmpty: {
                            message: "The email is required"
                        },
                        emailAddress: {
                            message: "The value is not a valid email address"
                        }
                    }
                },
                cus_tel_no: {
                    validators: {
                        notEmpty: {
                            message: "The phone number is required"
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: "The phone number can only consist of digits"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".col-sm-6"
                }),
                autoFocus: new FormValidation.plugins.AutoFocus(),
                submitButton: new FormValidation.plugins.SubmitButton()
            },
            init: function(instance) {
                instance.on("plugins.message.placed", function(event) {
                    if (event.element.parentElement.classList.contains("input-group")) {
                        event.element.parentElement.insertAdjacentElement("afterend", event.messageElement);
                    }
                });
            }
        }).on("core.form.valid", function() {
            a.next();
        });

        // Validation for Step 2
        let t = FormValidation.formValidation(d, {
            fields: {
                url: {
                    validators: {
                        notEmpty: {
                            message: "The URL is required"
                        },
                        uri: {
                            message: "The URL is not proper"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".col-sm-6"
                }),
                autoFocus: new FormValidation.plugins.AutoFocus(),
                submitButton: new FormValidation.plugins.SubmitButton()
            }
        }).on("core.form.valid", function() {
            a.next();
        });

        // Validation for Step 3 (Review)
        let o = FormValidation.formValidation(m, {
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".col-sm-6"
                }),
                autoFocus: new FormValidation.plugins.AutoFocus(),
                submitButton: new FormValidation.plugins.SubmitButton()
            }
        }).on("core.form.valid", function() {
            alert("Submitted..!!");
        });

        // Handle Next Buttons
        uNextButtons.forEach(e => {
            e.addEventListener("click", function() {
                switch (a._currentIndex) {
                    case 0:
                        i.validate();
                        break;
                    case 1:
                        t.validate();
                        break;
                    case 2:
                        o.validate();
                        break;
                }
            });
        });

        // Handle Previous Buttons
        lPrevButtons.forEach(e => {
            e.addEventListener("click", function() {
                switch (a._currentIndex) {
                    case 2:
                    case 1:
                        a.previous();
                        break;
                }
            });
        });
    }
})();
