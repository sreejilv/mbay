$.validator.addMethod("validPass", function () {
    var isSuccess = false;
    $.ajax({url: "admin/report/check_current_password",
        data: {current_password: $("#current_password").val()},
        async: false,
        success:
        function (msg) {
            isSuccess = msg === "yes" ? true : false
        }
    });
    return isSuccess;
}, "Incorrect Password");

var validate_password_form = function () {
    var form = $('#password_form');
    var errorHandler1 = $('.errorHandler', form);
    var successHandler1 = $('.successHandler', form);
    form.validate({
            errorElement: "div", // contain the error msg in a span tag
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) { // render error placement for 
                error.appendTo($(element).closest('.form-group'));
            },
            ignore: ':hidden',
            rules: {
                current_password: {
                    required: true,
                    validPass: true

                },
                password: {
                    required: true,
                    minlength: 6,
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }

            },
            messages: {
                current_password: {
                    required: $('#current_password_req_js').html(),
                    validPass: $('#inv_current_password_js').html()
                },
                password: {
                    required: $('#new_password_req_js').html(),
                },
                confirm_password: {
                    required: $('#confirm_password_req_js').html(),
                    equalTo: $('#password_mismatch_js').html()
                }

            },
            invalidHandler: function(event, validator) { 

                successHandler1.hide();
                errorHandler1.show();
            },
            highlight: function(element) {
                $(element).closest('.form-control').removeClass('is-invalid');
                //display Checkbox invalid Data
                $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');
                // display OK icon
                $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function(element) { // revert the change done by hightlight
                //display Checkbox invalid Data

                $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');
                $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid').find('.symbol').removeClass('ok').addClass('required');
                // set error class to the control group
            },
            success: function(label, element) {
                //display Checkbox invalid Data
                $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');
                $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid').find('.symbol').removeClass('ok').addClass('required');
                // mark the current input as valid and display OK icon
            },
            submitHandler: function(form) {
                successHandler1.show();
                errorHandler1.hide();
                form.submit();
            }
        });
};



$('#country_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

    $.ajax({url: "register/get_states",
        data: {country_id: valueSelected},
        async: false,
        success: function (msg) {
            $('#state_span').html(msg);
            $("#state").select2({
                placeholder: "Select a State",
                allowClear: false
            });
        }
    });

});

$('#country_1').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

    $.ajax({url: "register/get_states",
        data: {country_id: valueSelected},
        async: false,
        success: function (msg) {
            $('#state_span_1').html(msg);
            $("#state").select2({
                placeholder: "Select a State",
                allowClear: false
            });
        }
    });

});

$(document).ready(function () {
    validate_password_form();
});
