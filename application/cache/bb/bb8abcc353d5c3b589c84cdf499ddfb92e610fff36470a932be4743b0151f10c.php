<?php

/* shop/cart.twig */
class __TwigTemplate_2212136c7f8959c2970f29885e4c50fe62e2dc9ce8a7a3cd7e8c6c395ee99b3d extends Twig_Template
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
        $this->loadTemplate("shop/layout/header.twig", "shop/cart.twig", 1)->display($context);
        // line 2
        echo "
        <!-- Breadcrumb-area -->
        <div class=\"breadcrumb-area bg-gray\">
            <div class=\"container\">
                <div class=\"breadcrumb-content text-center\">
                    <ul>
                        <li><a href=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "index\">Home</a></li>
                        <li><a href=\"";
        // line 9
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "shop\">Shop</a></li>
                        <li class=\"active\">Shop - SAMSUNG Galaxy A03s (Black, 32 GB)</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-area -->


        <!-- CART -->
        <section class=\"cart-main-area pt-115 pb-120 cart-area\">
            <div class=\"container\">
                <h3 class=\"cart-page-title\">Your cart items</h3>
                <div class=\"row\">
                    <div class=\"col-lg-8 col-md-12 col-sm-12 col-12\">
                        <form action=\"#\">
                            <div class=\"table-content table-responsive cart-table-content\">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Until Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!--loop item -->
                                        <tr>
                                            <td class=\"product-thumbnail\">
                                                <a href=\"#\"><img src=\"assets/shop/images/product/product-sample-1.jpg\"
                                                        alt=\"\"></a>
                                            </td>
                                            <td class=\"product-name\">
                                                <a href=\"#\">SAMSUNG Galaxy F13 (Waterfall Blue, 64
                                                    GB)</a>
                                                    <!-- if -5 quantity label -->
                                                    <span class=\"d-block text-success\"> Only 2 left in stock, order now.</span>
                                                    <!-- end if -5 quantity label -->
                                                </td>
                                            <td class=\"product-price-cart\"><span class=\"amount\">OMR 260.00</span></td>
                                            <td class=\"product-quantity pro-details-quality\">
                                                <div class=\"cart-plus-minus\">
                                                    <input class=\"cart-plus-minus-box\" type=\"text\" name=\"qtybutton\"
                                                        value=\"1\">
                                                </div>
                                                <a class=\"d-block\" href=\"#\">Remove</a>
                                            </td>
                                            <td class=\"product-subtotal\">OMR 110.00</td>
                                        </tr>
                                        <!--end loop item -->
                                        <!--loop item -->
                                        <tr>
                                            <td class=\"product-thumbnail\">
                                                <a href=\"#\"><img src=\"assets/shop/images/product/product-sample-1.jpg\"
                                                        alt=\"\"></a>
                                            </td>
                                            <td class=\"product-name\"><a href=\"#\">SAMSUNG Galaxy F13 (Waterfall Blue, 64
                                                    GB)</a>
                                                    <!-- if -5 quantity label -->
                                                    <span class=\"d-block text-success\"> Only 2 left in stock, order now.</span>
                                                    <!-- end if -5 quantity label -->
                                                </td>
                                            <td class=\"product-price-cart\"><span class=\"amount\">OMR 260.00</span></td>
                                            <td class=\"product-quantity pro-details-quality\">
                                                <div class=\"cart-plus-minus\">
                                                    <input class=\"cart-plus-minus-box\" type=\"text\" name=\"qtybutton\"
                                                        value=\"1\">
                                                </div>
                                                <a class=\"d-block\" href=\"#\">Remove</a>
                                            </td>
                                            <td class=\"product-subtotal\">OMR 110.00</td>
                                        </tr>
                                        <!--end loop item -->

                                    </tbody>
                                </table>
                            </div>



                        </form>
                    </div>
                    <div class=\"col-lg-4 col-md-12\">
                        <div class=\"grand-totall\">
                            <div class=\"title-wrap\">
                                <h4 class=\"cart-bottom-title section-bg-gary-cart\">Cart Total</h4>
                            </div>
                            <h5>Price (3 items) <span>OMR 260.00</span></h5>
                            <div class=\"total-shipping\">
                                <ul>
                                    <li>Delivery Charges <span>OMR 2.000</span></li>
                                    <li>Secured Packaging Fee <span>OMR 2.000</span></li>
                                </ul>
                            </div>
                            <h4 class=\"grand-totall-title\">Grand Total <span>OMR 260.00</span></h4>
                            <a href=\"";
        // line 107
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "checkout\">Checkout Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END CART -->";
        // line 116
        $this->loadTemplate("shop/layout/footer.twig", "shop/cart.twig", 116)->display($context);
    }

    public function getTemplateName()
    {
        return "shop/cart.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 116,  134 => 107,  33 => 9,  29 => 8,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "shop/cart.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\shop\\cart.twig");
    }
}
