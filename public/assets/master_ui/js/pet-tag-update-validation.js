(function() {
    var s = document.querySelector("#wizard-validation");

    if (s !== null) {
        var l = s.querySelector("#petCardUpdateForm");
        let e = l.querySelector("#step1"),
            d = l.querySelector("#step2"),
            m = l.querySelector("#step3"),
            u = l.querySelector("#step4"),
            uNextButtons = [].slice.call(l.querySelectorAll(".btn-next")),
            lPrevButtons = [].slice.call(l.querySelectorAll(".btn-prev"));

        let a = new Stepper(s, {
            linear: true
        });

        // Validation for Step 1 (Pet Owner Info)
        let i = FormValidation.formValidation(e, {
            fields: {
                name: {
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
                tel_no: {
                    validators: {
                        notEmpty: {
                            message: "The phone number is required"
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: "The phone number can only consist of digits"
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: "The email is required"
                        },
                        emailAddress: {
                            message: "The value is not a valid email address"
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: "The address is required"
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

        // Validation for Step 2 (Pet Details)
        let t = FormValidation.formValidation(d, {
            fields: {
                pet_name: {
                    validators: {
                        notEmpty: {
                            message: "The pet name is required"
                        }
                    }
                },
                date_of_birth: {
                    validators: {
                        notEmpty: {
                            message: "The date of birth is required"
                        }
                    }
                },
                bio: {
                    validators: {
                        notEmpty: {
                            message: "The bio is required"
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

        // Validation for Step 3 (Vaccination Details)
        let o = FormValidation.formValidation(m, {
            fields: {
                vaccine: {
                    validators: {
                        notEmpty: {
                            message: "The vaccine name is required"
                        }
                    }
                },
                vaccination_date: {
                    validators: {
                        notEmpty: {
                            message: "The vaccination date is required"
                        }
                    }
                },
                next_vaccination_date: {
                    validators: {
                        notEmpty: {
                            message: "The next vaccination date is required"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".col-lg-6"
                }),
                autoFocus: new FormValidation.plugins.AutoFocus(),
                submitButton: new FormValidation.plugins.SubmitButton()
            }
        }).on("core.form.valid", function() {
            a.next();
        });

        // No specific validation for Step 4 (Review), but you can add if needed

        // Handle Next Buttons
        uNextButtons.forEach(e => {
            e.addEventListener("click", e => {
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
            e.addEventListener("click", e => {
                a.previous();
            });
        });
    }
})();
