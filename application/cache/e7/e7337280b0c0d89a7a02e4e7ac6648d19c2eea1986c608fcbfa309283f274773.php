<?php

/* cart/shopping_cart.twig */
class __TwigTemplate_2ce18bbc87373c7d2f7d45b2011bb152723854a87f9f437f62b3942c2458df00 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"js_messages\" style=\"display: none;\"> 
    <span id=\"product_deleted_js\">";
        // line 2
        echo twig_escape_filter($this->env, lang("product_deleted_js"), "html", null, true);
        echo "</span>    
    <span id=\"success_js\">";
        // line 3
        echo twig_escape_filter($this->env, lang("success_js"), "html", null, true);
        echo "</span>    
    <span id=\"failed_product_delete_js\">";
        // line 4
        echo twig_escape_filter($this->env, lang("failed_product_delete_js"), "html", null, true);
        echo "</span>    
    <span id=\"failed_js\">";
        // line 5
        echo twig_escape_filter($this->env, lang("failed_js"), "html", null, true);
        echo "</span>    
    <span id=\"remove_js\">";
        // line 6
        echo twig_escape_filter($this->env, lang("remove_js"), "html", null, true);
        echo "</span>    
    <span id=\"price_js\">";
        // line 7
        echo twig_escape_filter($this->env, lang("price_js"), "html", null, true);
        echo "</span>    
    <span id=\"quantity_js\">";
        // line 8
        echo twig_escape_filter($this->env, lang("quantity_js"), "html", null, true);
        echo "</span>    
    <span id=\"desc_js\">";
        // line 9
        echo twig_escape_filter($this->env, lang("desc_js"), "html", null, true);
        echo "</span>    
    <span id=\"no_products_js\">";
        // line 10
        echo twig_escape_filter($this->env, lang("no_products_js"), "html", null, true);
        echo "</span>
</div>
<div class=\"col-sm-12 col-xs-12 toolbar\" id='cart_toolbar' style=\"height: 35px;\">            
    <div class=\"toolbar-tools pull-right\">
        <ul class=\"nav navbar-right\">
            <li class=\"dropdown\" >
                <button type=\"button\" data-toggle=\"dropdown\" data-loading-text=\"Loading...\" class=\"btn btn-light-grey dropdown-toggle\" aria-expanded=\"false\">
                    <i class=\"fa fa-shopping-cart\"></i> 
                    <small>";
        // line 18
        echo twig_escape_filter($this->env, lang("price"), "html", null, true);
        echo " (<span id=\"cart_prod_count\" class=\"text-bold\">";
        echo twig_escape_filter($this->env, ($context["items"] ?? null), "html", null, true);
        echo "</span> -";
        echo twig_escape_filter($this->env, lang("items"), "html", null, true);
        echo ") :<span id=\"cart_tot_amount\" class=\"text-bold\">";
        echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_LEFT"] ?? null), "html", null, true);
        echo twig_escape_filter($this->env, twig_round((($context["total_items_amount"] ?? null) * ($context["MLM_CURRENCY_VALUE"] ?? null)), ($context["CURRENCY_ROUND"] ?? null), "floor"), "html", null, true);
        echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_RIGHT"] ?? null), "html", null, true);
        echo "</span> 
                    </small>
                </button>                                                
                <ul class=\"dropdown-menu dropdown-light dropdown-messages\" style=\"padding: 10px;\">
                    <li>
                        <div class=\"drop-down-wrapper ps-container\">
                            <div id='shopping_cart'>
                            </div>
                        </div>
                    </li>
                    <li class=\"view-all\" id='checkout_div'>
                        <div class='form-group'>
                            <table class=\"table\">
                                <tbody style=\"font-weight: bold;\">
                                    <tr>
                                        <td class=\"text-right\" width=\"70%;\">";
        // line 33
        echo twig_escape_filter($this->env, lang("sub_total"), "html", null, true);
        echo "</td>
                                        <td width=\"5%;\">:</td>
                                        <td class=\"text-left\"  width=\"25%;\"><span id=\"cart_prod_total\">";
        // line 36
        echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_LEFT"] ?? null), "html", null, true);
        echo twig_escape_filter($this->env, twig_round((($context["total_amount"] ?? null) * ($context["MLM_CURRENCY_VALUE"] ?? null)), ($context["CURRENCY_ROUND"] ?? null), "floor"), "html", null, true);
        echo twig_escape_filter($this->env, ($context["MLM_CURRENCY_RIGHT"] ?? null), "html", null, true);
        echo "</span></td>
                                    </tr>
                                    <tr id=\"cart_delivery_charge_div\">
                                        <td class=\"text-right\" width=\"70%;\">";
        // line 39
        echo twig_escape_filter($this->env, lang("delivery_charge"), "html", null, true);
        echo " </td>
                                        <td width=\"5%;\">:</td>
                                        <td class=\"text-left\" width=\"25%;\"><span id=\"cart_delivery_charge\">0</span></td>
                                    </tr>
                                    <tr id=\"cart_shipping_charge_div\">
                                        <td class=\"text-right\" width=\"70%;\">";
        // line 44
        echo twig_escape_filter($this->env, lang("shipping_charge"), "html", null, true);
        echo " </td>
                                        <td width=\"5%;\">:</td>
                                        <td class=\"text-left\" width=\"25%;\"><span id=\"cart_shipping_charge\">0</span></td>
                                    </tr>
                                    <tr id=\"cart_tax_div\">
                                        <td class=\"text-right\" width=\"70%;\">";
        // line 49
        echo twig_escape_filter($this->env, lang("tax"), "html", null, true);
        echo " </td>
                                        <td width=\"5%;\">:</td>
                                        <td class=\"text-left\" width=\"25%;\"><span id=\"cart_tax\">0</span></td>
                                    </tr>
                                    <tr>
                                        <td class=\"text-right\" width=\"70%;\">";
        // line 54
        echo twig_escape_filter($this->env, lang("amount_payable"), "html", null, true);
        echo " </td>
                                        <td width=\"5%;\">:</td>
                                        <td class=\"text-left\" width=\"25%;\"><span id=\"cart_grand_total\">0</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class=\"text-right\">
                                <a class=\"btn btn-default\" href=\"shopping-view\">
                                     <strong> <i class=\"fa fa-shopping-cart\"></i>";
        // line 62
        echo twig_escape_filter($this->env, lang("view_cart"), "html", null, true);
        echo "</strong>
                                </a>
                                <a class=\"btn btn-default\" href=\"shopping-checkout\">
                                    <strong> <i class=\"fa fa-share\"></i>";
        // line 65
        echo twig_escape_filter($this->env, lang("checkout"), "html", null, true);
        echo "</strong>
                                </a>
                            </p>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>                
    </div>    
</div>
<style>

    #cart_toolbar {
        border-bottom: 0px !important;
    }

    .table th, .table td { 
         border-top: none !important; 
     }

    .table th, .table td   { 
         padding: 2px !important; 
         font-size: 14px !important; 
         color: #676767; 
     }
</style>
<script>
    update_shopping_cart();

    function removeProduct(key) {
        \$.ajax({
            url: \"cart/remove_product\",
            data: {key: key},
            success: function (res) {
                if (res.trim() == \"yes\")
                {
                    var msg = \$('#product_deleted_js').html();//\"Product Deleted\";
                    var flag = \"success\";
                    var title = \$('#success_js').html();//\"Success\";
                    update_cart_view();
                    update_shopping_cart();
                    cart_notification(flag, title, msg);
                }
                else
                {
                    var msg = \$('#failed_product_delete_js').html();
                    var flag = \"error\";
                    var title = \$('#failed_js').html();
                    cart_notification(flag, title, msg);
                }
            }
        });
    }

    var refresh_shopping_cart = function (chat_data) {
        var remove = \$('#remove_js').html();
        var price = \$('#price_js').html();
        var quantity = \$('#quantity_js').html();
        var desc = \$('#desc_js').html();
        var no_products = \$('#no_products_js').html();
        var flag = 1;

        var html = '<table class=\"table\"><tbody>';
        for (var key in chat_data) {
            html += '<tr>';
            html += '<td class=\"text-left\" width=\"12%\"> <img src=\"assets/images/products/' + chat_data[key]['image'] + '\" class=\"img-thumbnail\" style=\"width:100%;\" ></a> </td>';
            html += '<td class=\"text-center\" width=\"38%\">' + chat_data[key]['short_name'] + '</td>';
            html += '<td class=\"text-right\" width=\"12%\"> x ' + chat_data[key]['qty'] + '</td>';
            html += '<td class=\"text-right\" width=\"2%\">:</td>';
            html += '<td class=\"text-right\" width=\"24%\">' + chat_data[key]['conv_price'] + '</td>';
            html += '<td class=\"text-center\" width=\"12%\"><button type=\"button\" onclick=\"removeProduct(' + \"'\" + key + \"'\" + ')\" title=\"Remove\" class=\"btn btn-danger btn-xs\" style=\"height:20px;\"><i class=\"fa fa-times\"></i></button></td>';
            html += '</tr>';
            flag = 0;
        }
        html += '</tbody></table>';
        if (flag == 1) {
            \$(\"#checkout_div\").hide();
            var html = '<div>' + no_products + '</div>';
        } else {
            \$(\"#checkout_div\").show();
        }
        \$(\"#shopping_cart\").html(html);
    }

    function update_shopping_cart() {
        \$.getJSON('cart/refresh_price', function (data) {
            \$(\"#cart_tot_amount\").html(data['grand_total']);
            \$(\"#cart_prod_total\").html(data['total_amount']);
            \$(\"#cart_prod_count\").html(data['items']);            
            \$(\"#cart_delivery_charge\").html(data['delivery_charge']);
            \$(\"#cart_shipping_charge\").html(data['shipping_charge']);
            \$(\"#cart_tax\").html(data['tax']);
            \$(\"#cart_grand_total\").html(data['grand_total']);
            
            \$(\"#cart_delivery_charge_div\").hide();
            \$(\"#cart_shipping_charge_div\").hide();
            \$(\"#cart_tax_div\").hide();
            
            
            if(data['delivery_charge_only']>0){
                \$(\"#cart_delivery_charge_div\").show();
            }
            
            if(data['shipping_charge_only']>0){
                \$(\"#cart_shipping_charge_div\").show();
            }
            
            if(data['tax_only']>0){
                \$(\"#cart_tax_div\").show();
            }
            
            
        });

        \$.getJSON('cart/refresh_cart', function (data) {
            refresh_shopping_cart(data);
        });
    }

    setInterval(function () {
        update_shopping_cart();
    }, 2000);

</script>";
    }

    public function getTemplateName()
    {
        return "cart/shopping_cart.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 65,  139 => 62,  128 => 54,  120 => 49,  112 => 44,  104 => 39,  96 => 36,  91 => 33,  65 => 18,  54 => 10,  50 => 9,  46 => 8,  42 => 7,  38 => 6,  34 => 5,  30 => 4,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "cart/shopping_cart.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\cart\\shopping_cart.twig");
    }
}
