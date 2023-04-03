$(".qtybutton").click(function(){
  let prod =$(this).parent('div');
  let btnval =$(this).html();
  if(btnval== "+"){
    incrementProduct(prod.attr("prod-id"));
  } else if(btnval== "-") {
    decrementProduct(prod.attr("prod-id"));
  } 
  
});

update_cart_view();

function incrementProduct(key) {
    $.ajax({
        url: "cart/add_product_count",
        data: {key: key},
        success: function (res) {
            var obj=$.parseJSON(res);
            if (obj.status== "yes")
            {
                $("#product_amount_total_"+key).html(obj.value);
                toastr.success('Success');
                update_cart_view();
            }
            else
            {
                var msg = obj.status;
                toastr.error(msg);
            }
        }
    });
}

function decrementProduct(key) {
    var items = $("#items_count").val();
    $.ajax({
        url: "cart/ded_product_count",
        data: {key: key},
        success: function (res) {
            var obj=$.parseJSON(res);
            if (obj.status== "yes")
            {
                $("#product_amount_total_"+key).html(obj.value);
                if(obj.value==0 && items==0){
                    window.location.href='./';
                }
                else if(obj.value==0){
                    location.reload();
                }
                update_cart_view();
                toastr.success('Success');
            }
            else
            {
                var msg = res;//$('#failed_to_add_js').html();
                toastr.error(msg)
            }
        }
    });
}

function clearProduct(key) {
    $.ajax({
        url: "cart/remove_product",
        data: {key: key},
        success: function (res) {
            if (res.trim() == "yes")
            {
                toastr.success('Success')
                update_cart_view();
                setTimeout(function() {
                    location.reload();
                }, 300);
            }
            else
            {
                var msg = res;//$('#failed_to_add_js').html();
                toastr.error(msg)
            }
        }
    });
}

function quantityChange(key,index) {
    var items = $("#items_count").val();
    $.ajax({
        url: "cart/quantity_change",
        data: {key: key, quantity: $("#qtybutton_"+index).val()},
        success: function (res) {
            var obj=$.parseJSON(res);
            if (obj.status.trim() == "yes")
            {
                update_cart_view();
                toastr.success('Success')
                $("#product_amount_total_"+key).html(obj.value);
                if(obj.value<=0 && items==0){
                    window.location.href='./';
                }
                else if(obj.value<=0){
                    location.reload();
                }
            }
            else
            {
                var msg = obj.status;
                toastr.error(msg)
            }
        }
    });
}

var refresh_cart = function (chat_data) {

    var remove = $('#remove_js').html();
    var price = $('#price_js').html();
    var quantity = $('#quantity_js').html();
    var desc = $('#description_js').html();
    var no_products = $('#empty_cart_js').html();
    var flag = 1;
    var html = '<ul class="activities">';
    for (var key in chat_data) {
        

     // html += '<li id="key_' + key + '" class="messages-item">';
     // html += '<div class="row">'

     // html += '<div class="col-md-2 col-sm-2 col-xs-2"  style="height: 90px;line-height: 90px; text-align: center;">'
     // html += '<img alt="image" src="assets/shop/images/product/' + chat_data[key]['image'] + '" width="95%;" height="auto">'
     // html += '</div>'

     // html += '<div class="col-md-5 col-sm-5 col-xs-5"> ';
     // html += '<span class="text-bold"> ' + chat_data[key]['name'] + ' </span><br/>';
     // html += '<span><small>' + price + ' : ' + chat_data[key]['conv_price'] + '</small></span><br/>';
     // html += '<span ><small>' + quantity + ' : ' + chat_data[key]['qty'] + '</small></span><br/>';
     // html += '<span ><small>' + desc + ' : ' + chat_data[key]['description'] + '</small></span>'
     // html += '</div>';

     // html += '<div class="col-md-3 col-sm-3 col-xs-3" style="height: 90px;line-height: 90px; text-align: center;">';
     // html += '<button class="cart-plus-minus" style="border-radius: 45%!important;" onclick="decrementProduct(' + "'" + key + "'" + ')"> – </button>';
     // html += ' <span id="quantity_' + key + '"> <b>' + chat_data[key]['qty'] + ' </b></span> ';
     // html += '<button class="cart-plus-minus" style="border-radius: 45%!important;" onclick="incrementProduct(' + "'" + key + "'" + ')"> + </button>';
     // html += '</div>';

     // html += '<div class="col-md-2 col-sm-2 col-xs-2"  style="height: 90px;line-height: 90px; text-align: center;">'
     // html += '<button class="btn btn-red  btn-xs" onclick="clearProduct(' + "'" + key + "'" + ')"> <i class="fa fa-times fa fa-white"></i> </button>';
     // html += '</div>';

     // html += '</div>';
     // html += '</li>';


        flag = 0;
    }
    html += '</ul>';
    if (flag == 1) {
        var html = '<div>' + no_products + '</div>';
    }
    $("#product_list_view").html(html);
}


var refresh_price = function (chat_data) {
    $("#view_grand_total").html(chat_data['total_amount']);
    $("#view_prod_total").html(chat_data['total_amount']);
    $("#view_prod_count").html(chat_data['items']);
    $("#view_delivery_charge").html(chat_data['delivery_charge']);
    $("#view_shipping_charge").html(chat_data['shipping_charge']);
    $("#view_tax").html(chat_data['tax']);
    $("#view_grand_total").html(chat_data['grand_total']);
}

function update_cart_view() {
    $.getJSON('cart/refresh_cart', function (data) {
        refresh_cart(data);

    });

    $.getJSON('cart/refresh_price', function (data) {
        refresh_price(data);
        $("#grand-totall").load(" #grand-totall> *");
        // $(".cart-table-content").load(" .cart-table-content> *");

    });

}
