$.validator.addMethod("ckeditor_required", function (value, element) {
    var editorData = element.innerText;
    console.log(editorData);
    if (editorData) {
        return true;
    }
    return false;
}, "This field is required.");

var validate_product = function () {
    var form = $('#pristine-valid-example');
    var errorHandler1 = $('.errorHandler', form);
    var successHandler1 = $('.successHandler', form);
    $(form).validate({
        ignore: [],
            errorElement: "div", // contain the error msg in a span tag
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.hasClass("ck-editor")) {
                    error.insertBefore(element);
                } else if (element.attr("name") == "description") {
                    $("#errordescription").append(error);
                } else {
                    error.appendTo($(element).closest('.form-group'));
                }
            },

            rules: {
                "images[]": {
                    required: true,
                },
                product_name: {
                    required: true,
                },
                quantity: {
                    required: true,
                    digits: true
                },
                description: {
                    ckeditor_required: true,
                },
                product_amount: {
                    required: true,
                    digits: true
                },
                category: {
                    required: true,
                },
                brand: {
                    required: true,
                },
                sort_order: {
                    required: true,
                },
                keyword: {
                    required: true,
                }

            },
            messages: {
                "images[]": "Please select Image",
                product_name: {
                    required: 'Required',
                },
                quantity: {
                    required: 'Required',
                    digits: 'Only Number Format',
                },
                description: {
                    ckeditor_required: 'This field is required',
                },
                product_amount: {
                    required: 'Required',
                    digits: 'Only Number Format',
                },
                category: {
                    required: 'Required',
                },
                brand: {
                    required: 'Required',
                },
                sort_order: {
                    required: 'Required',
                },
                keyword: {
                    required: 'Required',
                }
            },
            invalidHandler: function (event, validator) {

                successHandler1.hide();
                errorHandler1.show();
            },
            highlight: function (element) {
                $(element).closest('.form-control').removeClass('is-invalid');
                //display Checkbox invalid Data
                $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');
                // display OK icon
                $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid').find(
                    '.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                //display Checkbox invalid Data

                $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');
                $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid').find(
                    '.symbol').removeClass('ok').addClass('required');
                // set error class to the control group
            },
            success: function (label, element) {
                //display Checkbox invalid Data
                $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');
                $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid').find(
                    '.symbol').removeClass('ok').addClass('required');
                // mark the current input as valid and display OK icon
            },
            submitHandler: function (form) {
                successHandler1.show();
                errorHandler1.hide();
                form.submit();
            }
        });
};
$('.input-images-1').imageUploader({
    maxFiles: 6,

});

function product_delete(id) {
    var are_you_sure_js = $('#are_you_sure_js').html();
    var cancel_it_js = $('#cancel_it_js').html();
    var canceled_js = $('#canceled_js').html();  

    var product_safe_js = $('#product_safe_js').html();

    var delete_this_product_js = $('#delete_this_product_js').html();
    var delete_it_js = $('#delete_it_js').html();

    swal({
        title: are_you_sure_js,
        text: delete_this_product_js,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: delete_it_js,
        cancelButtonText: cancel_it_js,
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            document.location.href = 'admin/product-manage/delete/' + id;
        } else {
            swal(canceled_js, product_safe_js, "error");
        }
    }); 
} 