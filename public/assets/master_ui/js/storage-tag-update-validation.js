(function() {
    var s = document.querySelector("#wizard-validation");

    if (s !== null) {
        var l = s.querySelector("#storageCardUpdateForm");
        let e = l.querySelector("#step1"),
            d = l.querySelector("#step2"),
            uNextButtons = [].slice.call(l.querySelectorAll(".btn-next")),
            lPrevButtons = [].slice.call(l.querySelectorAll(".btn-prev"));

        let a = new Stepper(s, {
            linear: true
        });

        // Validation for Step 1
        let i = FormValidation.formValidation(e, {
            fields: {
                product_name: {
                    validators: {
                        notEmpty: {
                            message: "The product name is required"
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: "The product name must be more than 3 and less than 30 characters long"
                        }
                    }
                },
                product_weight: {
                    validators: {
                        notEmpty: {
                            message: "The product weight is required"
                        },
                        numeric: {
                            message: "The product weight must be a number"
                        }
                    }
                },
                manufactured_date: {
                    validators: {
                        notEmpty: {
                            message: "The manufacture date is required"
                        },
                        date: {
                            format: "YYYY-MM-DD",
                            message: "The value is not a valid date"
                        }
                    }
                },
                expiration_date: {
                    validators: {
                        notEmpty: {
                            message: "The expiry date is required"
                        },
                        date: {
                            format: "YYYY-MM-DD",
                            message: "The value is not a valid date"
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

        // Validation for Step 2
        let t = FormValidation.formValidation(d, {
            fields: {
                storageAvatar: {
                    validators: {
                        notEmpty: {
                            message: "The image is required"
                        }
                    }
                },
                product_details: {
                    validators: {
                        notEmpty: {
                            message: "The product details are required"
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

        // Validation for Step 3 (Review & Submit) - No specific validation needed here

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
                }
            });
        });

        // Handle Previous Buttons
        lPrevButtons.forEach(e => {
            e.addEventListener("click", e => {
                switch (a._currentIndex) {
                    case 1:
                        a.previous();
                        break;
                }
            });
        });
    }
})();
