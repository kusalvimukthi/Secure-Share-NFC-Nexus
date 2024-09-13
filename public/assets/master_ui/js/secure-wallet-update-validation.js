(function() {
    var s = document.querySelector("#wizard-validation");

    if (s !== null) {
        var l = s.querySelector("#updateWalletForm");
        let e = l.querySelector("#step1"),
            d = l.querySelector("#step2"),
            m = l.querySelector("#step3"),
            u = l.querySelector("#step4"),
            uNextButtons = [].slice.call(l.querySelectorAll(".btn-next")),
            lPrevButtons = [].slice.call(l.querySelectorAll(".btn-prev"));

        let a = new Stepper(s, {
            linear: true
        });

        // Validation for Step 1 - Password Info
        let i = FormValidation.formValidation(e, {
            fields: {
                'url-1': {
                    validators: {
                        notEmpty: {
                            message: "The URL is required"
                        },
                        uri: {
                            message: "The URL is not valid"
                        }
                    }
                },
                'username-1': {
                    validators: {
                        notEmpty: {
                            message: "The username is required"
                        }
                    }
                },
                'password-1': {
                    validators: {
                        notEmpty: {
                            message: "The password is required"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".col-lg-6" // Adjust the row selector as needed
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

        // Validation for Step 2 - Editor Panel
        let t = FormValidation.formValidation(d, {
            fields: {
                // No specific fields to validate here, add if necessary
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".col-sm-12"
                }),
                autoFocus: new FormValidation.plugins.AutoFocus(),
                submitButton: new FormValidation.plugins.SubmitButton()
            }
        }).on("core.form.valid", function() {
            a.next();
        });

        // Validation for Step 3 - Extra Note
        let o = FormValidation.formValidation(m, {
            fields: {
                'note': {
                    validators: {
                        notEmpty: {
                            message: "The extra note is required"
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".col-sm-12"
                }),
                autoFocus: new FormValidation.plugins.AutoFocus(),
                submitButton: new FormValidation.plugins.SubmitButton()
            }
        }).on("core.form.valid", function() {
            a.next();
        });

        // Validation for Step 4 - Review & Submit
        let p = FormValidation.formValidation(u, {
            fields: {
                // No specific fields to validate here, add if necessary
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".col-sm-12"
                }),
                autoFocus: new FormValidation.plugins.AutoFocus(),
                submitButton: new FormValidation.plugins.SubmitButton()
            }
        }).on("core.form.valid", function() {
            alert("Form Submitted..!!");
        });

        // Handle Next Buttons
        uNextButtons.forEach(e => {
            e.addEventListener("click", () => {
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
            e.addEventListener("click", () => {
                a.previous();
            });
        });
    }
})();
