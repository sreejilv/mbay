$.validator.addMethod("ckeditor_required", function(value, element) {
       var editorData = element.innerText;
       console.log(editorData);
       if(editorData){
        return true;
       }
       return false;
    }, "This field is required.");


// var validate_user_profile = function () {
//     var form = $('#pristine-valid-example');
//     var errorHandler1 = $('.errorHandler', form);
//     var successHandler1 = $('.successHandler', form);
//     $(form).validate({
//               ignore: [],
//               errorElement: "div", // contain the error msg in a span tag
//               errorClass: 'invalid-feedback',
//               errorPlacement: function (error, element) { // render error placement for each input type
//                      if (element.hasClass("ck-editor")) {
//                             error.insertBefore(element);
//                      }else if (element.attr("name") == "description") {
//                             $("#errordescription").append(error);
//                      } else{
//                             error.appendTo($(element).closest('.form-group'));
//                      }  
//               },
              
//               rules: {
//                      "images[]" : {
//                             required: true,
//                      },
//                      category: {
//                            required: true,
//                      },
//                        // parent: {
//                        //     required: true,
//                        // },
//                      description: {
//                            ckeditor_required: true,
//                      },
//                      sort_order: {
//                            required: true,
//                            digits: true
//                      },
//                      keyword:{
//                            required: true, 
//                      }
//               },
//               messages: {
//                      "images[]": "Please select Image",
//                      //        category: {
//                      //        required: 'Required',
//                      // }, 
//                      // parent: {
//                      //     required: 'Required',
//                      // },
//                 category: {
//                      required: 'Required',
//                      },
//                      description: {
//                      ckeditor_required: 'Required',
//                      }, 
//                      sort_order: {
//                      required: 'Required',
//                      digits: 'Only Number Format',
//                      },
//                      keyword: {
//                      required: 'Required',
//                      }
//               },
//               invalidHandler: function(event, validator) { 

//                      successHandler1.hide();
//                      errorHandler1.show();
//               },
//               highlight: function(element) {
//                      $(element).closest('.form-control').removeClass('is-invalid');
//                      //display Checkbox invalid Data
//                      $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');
//                      // display OK icon
//                      $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid').find('.symbol').removeClass('ok').addClass('required');
//                      // add the Bootstrap error class to the control group
//               },
//               unhighlight: function(element) { // revert the change done by hightlight
//                      //display Checkbox invalid Data
//                      $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');
//                      $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid').find('.symbol').removeClass('ok').addClass('required');
//                      // set error class to the control group
//               },
//               success: function(label, element) {
//                      //display Checkbox invalid Data
//                      $(element).closest('.checkbox').removeClass('is-invalid').addClass('is-valid');
//                      $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid').find('.symbol').removeClass('ok').addClass('required');
//                      // mark the current input as valid and display OK icon
//               },
//               submitHandler: function(form) {
//                      successHandler1.show();
//                      errorHandler1.hide();
//                      form.submit();
//               }
//        });
//     };


function cat_delete(id) {
        var are_you_sure_js = $('#are_you_sure_js').html();
        var cancel_it_js = $('#cancel_it_js').html();
        var canceled_js = $('#canceled_js').html();  

        var category_safe_js = $('#category_safe_js').html();

        var delete_this_category_js = $('#delete_this_category_js').html();
        var delete_it_js = $('#delete_it_js').html();

        swal({
            title: are_you_sure_js,
            text: delete_this_category_js,
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
                document.location.href = 'admin/categories/cat_delete/' + id;
            } else {
                swal(canceled_js, category_safe_js, "error");
            }
        }); 
}

// var product_id = {{ product_id }};

//        var image = {{ cat_image|json_encode|raw }};
//               $('.input-images-2').imageUploader({
//               preloaded: image,
//               maxFiles: 10
//        });
    
//        $('.delete-image').on('click', function(){
//        var parent = $(this).parent().children("input").val();
//               $.ajax({
//               url: "admin/product/imagedelete",
 
//               data: {
//                      parent: parent,
//                      product_id:product_id
//               },
//               success: function (res) {
//               console.log($res);
//               }
//        });

// }) 

// $(function() {
//    validate_user_profile();
// });

// $(document).ready(function () {
//     validate_user_profile();
// });
