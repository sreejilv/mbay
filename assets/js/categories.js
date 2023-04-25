$.validator.addMethod("ckeditor_required", function(value, element) {
       var editorData = element.innerText;
       console.log(editorData);
       if(editorData){
        return true;
       }
       return false;
    }, "This field is required.");


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
