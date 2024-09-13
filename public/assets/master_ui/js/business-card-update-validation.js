(function() {
    var s = document.querySelector("#wizard-validation");

    if (s !== null) {
        var l = s.querySelector("#businessCardUpdateForm");
        let e = l.querySelector("#step1"),
            d = l.querySelector("#step2"),
            m = l.querySelector("#step3"),
            u = l.querySelector("#step4"),
            uNextButtons = [].slice.call(l.querySelectorAll(".btn-next")),
            lPrevButtons = [].slice.call(l.querySelectorAll(".btn-prev"));

        let a = new Stepper(s, {
            linear: true
        });

        // Validation for Step 1: Business Card Info
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
                },
                company_name: {
                    validators: {
                        notEmpty: {
                            message: "The company name is required"
                        }
                    }
                },
                designation: {
                    validators: {
                        notEmpty: {
                            message: "The designation is required"
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

        // Validation for Step 2: Extra Details
        let t = FormValidation.formValidation(d, {
            fields: {
                bio: {
                    validators: {
                        notEmpty: {
                            message: "The bio is required"
                        }
                    }
                },
                businessCardAvatar: {
                    validators: {
                        file: {
                            extension: 'jpeg,jpg,png',
                            type: 'image/jpeg,image/png',
                            maxSize: 800 * 1024, // 800KB
                            message: 'Please choose a valid image file with max size of 800KB'
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

        // Validation for Step 3: Social Links
        let o = FormValidation.formValidation(m, {
            fields: {
                webLink: {
                    validators: {
                        notEmpty: {
                            message: "The website link is required"
                        },
                        uri: {
                            message: "The URL is not proper"
                        }
                    }
                },
                portfolio: {
                    validators: {
                        notEmpty: {
                            message: "The portfolio URL is required"
                        },
                        uri: {
                            message: "The URL is not proper"
                        }
                    }
                },
                twitter: {
                    validators: {
                        uri: {
                            message: "The Twitter URL is not proper"
                        }
                    }
                },
                facebook: {
                    validators: {
                        uri: {
                            message: "The Facebook URL is not proper"
                        }
                    }
                },
                linkedin: {
                    validators: {
                        uri: {
                            message: "The LinkedIn URL is not proper"
                        }
                    }
                },
                instagram: {
                    validators: {
                        uri: {
                            message: "The Instagram URL is not proper"
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

        // Validation for Step 4: Review (No specific validation needed)
        let p = FormValidation.formValidation(u, {
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
                    case 3:
                        p.validate();
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
