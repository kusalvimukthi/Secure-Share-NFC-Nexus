(function() {
    var s = document.querySelector("#wizard-validation");

    if (s !== null) {
        var l = s.querySelector("#customCardUpdateForm");
        let e = l.querySelector("#step1"),
            d = l.querySelector("#step2"),
            uNextButtons = [].slice.call(l.querySelectorAll(".btn-next")),
            lPrevButtons = [].slice.call(l.querySelectorAll(".btn-prev"));

        let a = new Stepper(s, {
            linear: true
        });

        // Validation for Step 1 (Custom URL)
        let i = FormValidation.formValidation(e, {
            fields: {
                url: {
                    validators: {
                        notEmpty: {
                            message: "The URL is required"
                        },
                        uri: {
                            message: "The URL is not valid"
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
            // Go to the next step if valid
            a.next();
        });

        // Handle Next Buttons
        uNextButtons.forEach(btn => {
            btn.addEventListener("click", function() {
                switch (a._currentIndex) {
                    case 0:
                        i.validate();
                        break;
                }
            });
        });

        // Handle Previous Buttons
        lPrevButtons.forEach(btn => {
            btn.addEventListener("click", function() {
                if (a._currentIndex > 0) {
                    a.previous();
                }
            });
        });
    }
})();
