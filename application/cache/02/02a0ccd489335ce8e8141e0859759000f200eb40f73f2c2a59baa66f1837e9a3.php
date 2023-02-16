<?php

/* shop/shop_details.twig */
class __TwigTemplate_9dd6d256a82a680c4159ef2e5067ab27c7626fcd15f192e3e5f60eeea0bea741 extends Twig_Template
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
        // line 2
        $this->loadTemplate("shop/layout/header.twig", "shop/shop_details.twig", 2)->display($context);
        // line 3
        echo "
        <!-- SIDEBAR CART -->
        <div class=\"sidebar-cart-active\">
            <div class=\"sidebar-cart-all\">
                <a class=\"cart-close\" href=\"#\"><i class=\"icon_close\"></i></a>
                <div class=\"cart-content\">
                    <h3>Shopping Cart</h3>
                    <ul>
                        <li class=\"single-product-cart\">
                            <div class=\"cart-img\">
                                <a href=\"#\"><img src=\"assets/shop/images/cart/cart-1.jpg\" alt=\"\"></a>
                            </div>
                            <div class=\"cart-title\">
                                <h4><a href=\"#\">Simple Black T-Shirt</a></h4>
                                <span> 1 × \$49.00 </span>
                            </div>
                            <div class=\"cart-delete\">
                                <a href=\"#\">×</a>
                            </div>
                        </li>
                        <li class=\"single-product-cart\">
                            <div class=\"cart-img\">
                                <a href=\"#\"><img src=\"assets/shop/images/cart/cart-2.jpg\" alt=\"\"></a>
                            </div>
                            <div class=\"cart-title\">
                                <h4><a href=\"#\">Norda Backpack</a></h4>
                                <span> 1 × \$49.00 </span>
                            </div>
                            <div class=\"cart-delete\">
                                <a href=\"#\">×</a>
                            </div>
                        </li>
                    </ul>
                    <div class=\"cart-total\">
                        <h4>Subtotal: <span>\$170.00</span></h4>
                    </div>
                    <div class=\"cart-checkout-btn\">
                        <a class=\"btn-hover cart-btn-style\" href=\"";
        // line 40
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "cart\">view cart</a>
                        <a class=\"no-mrg btn-hover cart-btn-style\" href=\"";
        // line 41
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "checkout\">checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SIDEBAR CART -->

        <!-- Breadcrumb-area -->
        <div class=\"breadcrumb-area bg-gray\">
            <div class=\"container\">
                <div class=\"breadcrumb-content text-center\">
                    <ul>
                        <li><a href=\"";
        // line 53
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "index\">Home</a></li>
                        <li><a href=\"";
        // line 54
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "shop\">Shop</a></li>
                        <li class=\"active\">Shop - SAMSUNG Galaxy A03s (Black, 32 GB)</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-area -->



        <!-- PRODUCT DEATILS -->
        <section class=\"product-details-area pt-120 pb-115\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-lg-5 col-md-5\">
                        <div class=\"product-details-tab\">

                            <!-- BIG SLIDER -->
                            <div class=\"pro-dec-big-img-slider nav-style-3\">

                                <!--loop image-->
                                <div class=\"item\">
                                    <img src=\"assets/shop/images/product/product-sample.jpg\"
                                        title=\"SAMSUNG Galaxy A03s (Black, 32 GB)\" class=\"img-fluid\"
                                        alt=\"SAMSUNG Galaxy A03s (Black, 32 GB)\">
                                </div>
                                <!--end loop image-->
                                <!--loop image-->
                                <div class=\"item\">
                                    <img src=\"assets/shop/images/product/product-sample-1.jpg\"
                                        title=\"SAMSUNG Galaxy A03s (Black, 32 GB)\" class=\"img-fluid\"
                                        alt=\"SAMSUNG Galaxy A03s (Black, 32 GB)\">
                                </div>
                                <!--end loop image-->


                            </div>
                            <!-- END BIG SLIDER -->


                        </div>
                    </div>

                    <div class=\"col-lg-7 col-md-7\">
                        <div class=\"product-details-content pro-details-content-mrg\">
                            <h2>SAMSUNG Galaxy A03s (Black, 32 GB)</h2>

                            <!--price-->
                            <div class=\"pro-details-price\">
                                <span class=\"new-price\">
                                    <r>OMR</r> 75.72
                                </span>
                                <span class=\"old-price\">
                                    <r>OMR</r> 95.72
                                </span>
                            </div>
                            <!--end price-->

                            <!--stock left message-->
                            <p class=\"text-danger my-1\">
                                Hurry, Only 6 left! 
                            </p>
                            <!--end stock left message-->

                            <!--outofstock-->
                            <div class=\"d-block mt-2 mb-3\">
                                <p class=\"text-danger mb-1\">
                                    This item is currently out of stock
                                </p>
                                <div class=\"input-group d-inline-flex w-auto\">  
                                    <input type=\"text\" class=\"form-control shadow-none\" placeholder=\"Your WhatsApp Number\"
                                        aria-label=\"Recipient's username\" aria-describedby=\"button-addon2\">
                                    <button class=\"btn btn-primary\" type=\"button\" id=\"button-addon2\">Notify Me</button>
                                </div>
                                <div class=\"valid-feedback d-block\">
                                    You will be notified by WhatsApp when this item is back in stock
                                  </div>
                            </div>
                            <!--end outofstock-->

                            <!--warrenty-->
                            <div class=\"product-warrenty\">
                                <div class=\"c-logo\">
                                    <img src=\"assets/shop/images/warranty/samsung.jpg\">
                                </div>
                                <div class=\"c-info\">
                                    Brand Warranty of 1 Year
                                </div>
                            </div>
                            <!--end warrenty-->

                            <!--color-->
                            <div class=\"product-color mt-3\">
                                <div class=\"color-title\">Color</div>
                                <div class=\"btn-group\" role=\"group\" aria-label=\"Basic radio toggle button group\">
                                    <input type=\"radio\" class=\"btn-check\" name=\"btnradio\" id=\"btnradio1\"
                                        autocomplete=\"off\">
                                    <label class=\"btn btn-sm btn-outline-primary\" for=\"btnradio1\"><span class=\"color\"
                                            style=\"background-color: #000;\"></span>Black</label>

                                    <input type=\"radio\" class=\"btn-check\" name=\"btnradio\" id=\"btnradio2\"
                                        autocomplete=\"off\">
                                    <label class=\"btn btn-sm btn-outline-primary\" for=\"btnradio2\"><span class=\"color\"
                                            style=\"background-color: rgb(0, 122, 221);\"></span>Blue</label>

                                    <input type=\"radio\" class=\"btn-check\" name=\"btnradio\" id=\"btnradio3\"
                                        autocomplete=\"off\">
                                    <label class=\"btn btn-sm btn-outline-primary\" for=\"btnradio3\"><span class=\"color\"
                                            style=\"background-color: rgb(85, 85, 85);\"></span>Grey</label>
                                </div>
                            </div>
                            <!--end color-->

                            <!--ram-->
                            <div class=\"product-color ram mt-3\">
                                <div class=\"color-title\">RAM</div>
                                <div class=\"btn-group\" role=\"group\" aria-label=\"Basic radio toggle button group\">
                                    <input type=\"radio\" class=\"btn-check\" name=\"btnradio\" id=\"btnradio11\"
                                        autocomplete=\"off\">
                                    <label class=\"btn btn-sm btn-outline-primary\" for=\"btnradio11\">2 GB</label>

                                    <input type=\"radio\" class=\"btn-check\" name=\"btnradio\" id=\"btnradio22\"
                                        autocomplete=\"off\">
                                    <label class=\"btn btn-sm btn-outline-primary\" for=\"btnradio22\">3 GB</label>
                                </div>
                            </div>
                            <!--end ram-->

                            <!--gb-->
                            <div class=\"product-color ram mt-3\">
                                <div class=\"color-title\">ROM</div>
                                <div class=\"btn-group\" role=\"group\" aria-label=\"Basic radio toggle button group\">
                                    <input type=\"radio\" class=\"btn-check\" name=\"btnradio\" id=\"btnradio11\"
                                        autocomplete=\"off\">
                                    <label class=\"btn btn-sm btn-outline-primary\" for=\"btnradio11\">256 GB</label>

                                    <input type=\"radio\" class=\"btn-check\" name=\"btnradio\" id=\"btnradio22\"
                                        autocomplete=\"off\">
                                    <label class=\"btn btn-sm btn-outline-primary\" for=\"btnradio22\">128 GB</label>
                                </div>
                            </div>
                            <!--end gb-->

                            <!--highlights-->
                            <div class=\"product-highlights mt-3\">
                                <div class=\"h-title\">
                                    Highlights
                                </div>
                                <div class=\"hightlights-single\">
                                    <ul>
                                        <li>4 GB RAM | 64 GB ROM | Expandable Upto 1 TB</li>
                                        <li>16.76 cm (6.6 inch) Full HD+ Display</li>
                                        <li>50MP + 5MP + 2MP | 8MP Front Camera</li>
                                        <li>6000 mAh Lithium Ion Battery</li>
                                        <li>Exynos 850 Processor</li>
                                    </ul>
                                </div>
                            </div>
                            <!--end highlights-->

                            <!--addtocart-buynow-->
                            <div class=\"action-button\">
                                <a class=\"btn btn-primary me-1\" href=\"#\" role=\"button\">Add to Cart</a>
                                <a class=\"btn btn-secondary\" href=\"#\" role=\"button\">Buy Now</a>
                            </div>
                            <!--end addtocart-buynow-->



                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- END PRODUCT DEATILS -->


        <!-- RELATED PRODUCT -->
        <div class=\"related-product pb-115 p-detail-page-related-product\">
            <div class=\"container\">
                <div class=\"section-title mb-45 text-center\">
                    <h2>Similar products</h2>
                </div>
                <div class=\"related-product-active\">

                    <!--single loop item-->
                    <div class=\"product-plr-1\">
                        <div class=\"single-product-wrap\">
                            <div class=\"product-img product-img-zoom mb-15\">
                                <a href=\"#\">
                                    <img src=\"assets/shop/images/product/product-sample.jpg\" alt=\"\">
                                </a>
                            </div>
                            <div class=\"product-content-wrap-2 text-center\">

                                <h3><a href=\"product-details.html\">SAMSUNG Galaxy A03s (Black, 32 GB)</a></h3>
                                <div class=\"product-price-2\">
                                    <span class=\"new-price\">OMR 35.45</span>
                                    <span class=\"old-price\">OMR 45.80</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end single loop item-->
                    <!--single loop item-->
                    <div class=\"product-plr-1\">
                        <div class=\"single-product-wrap\">
                            <div class=\"product-img product-img-zoom mb-15\">
                                <a href=\"#\">
                                    <img src=\"assets/shop/images/product/product-sample.jpg\" alt=\"\">
                                </a>
                            </div>
                            <div class=\"product-content-wrap-2 text-center\">

                                <h3><a href=\"product-details.html\">SAMSUNG Galaxy A03s (Black, 32 GB)</a></h3>
                                <div class=\"product-price-2\">
                                    <span class=\"new-price\">OMR 35.45</span>
                                    <span class=\"old-price\">OMR 45.80</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end single loop item-->

                </div>
            </div>
        </div>
        <!-- END RELATED PRODUCT -->";
        // line 286
        $this->loadTemplate("shop/layout/footer.twig", "shop/shop_details.twig", 286)->display($context);
    }

    public function getTemplateName()
    {
        return "shop/shop_details.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  316 => 286,  83 => 54,  79 => 53,  64 => 41,  60 => 40,  21 => 3,  19 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "shop/shop_details.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\shop\\shop_details.twig");
    }
}
