<?php

/* shop/shop.twig */
class __TwigTemplate_c751cbcb5b9fd024a5a021158a43cf40d758573ac1684ca2f687faf5e66b9f92 extends Twig_Template
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
        $this->loadTemplate("shop/layout/header.twig", "shop/shop.twig", 1)->display($context);
        // line 2
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
        // line 39
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "cart\">view cart</a>
                        <a class=\"no-mrg btn-hover cart-btn-style\" href=\"";
        // line 40
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
                        <li>
                            <a href=\"";
        // line 53
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "index\">Home</a>
                        </li>
                        <li class=\"active\">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-area -->



        <!-- SHOP PAGE -->
        <section class=\"shop-area pt-120 pb-120 section-padding-2\">
            <div class=\"container-fluid\">
                <div class=\"row flex-row-reverse\">

                    <div class=\"col-lg-9\">

                        <!-- FILTER MOBILE VIEW -->
                        <div class=\"shop-topbar-wrapper d-block d-md-block d-lg-none\">
                            <div class=\"shop-topbar-left\">
                                <div class=\"view-mode nav\">
                                    <a class=\"transform-90deg\" data-bs-toggle=\"offcanvas\" href=\"#offcanvasExample\" role=\"button\" aria-controls=\"offcanvasExample\"><i class=\"icon-equalizer\"></i></a>
                                </div>
                                <div class=\"product-sorting-wrapper\">
                                    <div class=\"product-show shorting-style\">
                                        <label>Sort by :</label>
                                        <select>
                                            <option value=\"\">Default</option>
                                            <option value=\"\"> Name</option>
                                            <option value=\"\"> price</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END FILTER MOBILE VIEW -->

                        <div class=\"row\">

                            <!--single loop item-->
                            <div class=\"col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6\">
                                <div class=\"single-product-wrap mb-35\">
                                    <div class=\"product-img product-img-zoom mb-20\">
                                        <a href=\"";
        // line 97
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "shop-details\">
                                            <img src=\"assets/shop/images/product/product-sample.jpg\" title=\"SAMSUNG Galaxy A03s (Black, 32 GB)\" alt=\"SAMSUNG Galaxy A03s (Black, 32 GB)\">
                                        </a>
                                        <span class=\"pro-badge left bg-red\">Label</span>
                                        <div class=\"product-action-wrap\">
                                            <div class=\"product-action-left\">
                                                <button><i class=\"icon-basket-loaded\"></i>Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=\"product-content-wrap\">
                                        <div class=\"product-content-left\">
                                             <h4><a href=\"#\" title=\"SAMSUNG Galaxy A03s (Black, 32 GB)\">SAMSUNG Galaxy A03s (Black, 32 GB)</a></h4>
                                             <!--gb-->
                                             <div class=\"gb\">
                                                4 GB RAM
                                             </div>
                                             <!--end gb-->
                                            <div class=\"product-price\">
                                                <span class=\"new-price\">OMR 46.00</span>
                                                <span class=\"old-price\">OMR 66.75</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end single loop item-->
                            <!--single loop item-->
                            <div class=\"col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6\">
                                <div class=\"single-product-wrap mb-35\">
                                    <div class=\"product-img product-img-zoom mb-20\">
                                        <a href=\"";
        // line 128
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "shop-details\">
                                            <img src=\"assets/shop/images/product/product-sample-1.jpg\" title=\"SAMSUNG Galaxy A03s (Black, 32 GB)\" alt=\"SAMSUNG Galaxy A03s (Black, 32 GB)\">
                                        </a>
                                        <span class=\"pro-badge left bg-red\">Label</span>
                                        <div class=\"product-action-wrap\">
                                            <div class=\"product-action-left\">
                                                <button><i class=\"icon-basket-loaded\"></i>Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=\"product-content-wrap\">
                                        <div class=\"product-content-left\">
                                             <h4><a href=\"#\" title=\"SAMSUNG Galaxy A03s (Black, 32 GB)\">SAMSUNG Galaxy A03s (Black, 32 GB)</a></h4>
                                            <div class=\"product-price\">
                                                <span class=\"new-price\">OMR 46.00</span>
                                                <span class=\"old-price\">OMR 66.75</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end single loop item-->

                        </div>
                        <div class=\"pro-pagination-style text-center mt-10\">
                            <ul>
                                <li><a class=\"prev\" href=\"#\"><i class=\"icon-arrow-left\"></i></a></li>
                                <li><a class=\"active\" href=\"#\">1</a></li>
                                <li><a href=\"#\">2</a></li>
                                <li><a class=\"next\" href=\"#\"><i class=\"icon-arrow-right\"></i></a></li>
                            </ul>
                        </div>

                    </div>

                    <!-- SIDE BAR -->
                    <div class=\"col-lg-3\">
                        <div class=\"sidebar-wrapper sidebar-wrapper-mrg-right d-none d-md-none d-lg-block\">
                            <!-- ACCORDION -->
                            <div class=\"accordion\" id=\"accordionPanelsStayOpenExample\">

                                <!-- PRICE -->
                                <div class=\"accordion-item price\">
                                    <h2 class=\"accordion-header\" id=\"panelsStayOpen-headingOne1\">
                                        <button class=\"accordion-button\" type=\"button\" data-bs-toggle=\"collapse\"
                                            data-bs-target=\"#panelsStayOpen-collapseOne1\" aria-expanded=\"true\"
                                            aria-controls=\"panelsStayOpen-collapseOne1\">
                                            Price
                                        </button>
                                    </h2>
                                    <div id=\"panelsStayOpen-collapseOne1\" class=\"accordion-collapse collapse show\"
                                        aria-labelledby=\"panelsStayOpen-headingOne1\">
                                        <div class=\"accordion-body\">
                                            <div class=\"input-group mb-3\">
                                                <span class=\"input-group-text\" id=\"basic-addon1\">OMR</span>
                                                <input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"50\" aria-label=\"Username\">
                                                <span class=\"input-group-text\">OMR</span>
                                                <input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"100\" aria-label=\"Server\">
                                                <button type=\"button\" class=\"btn btn-sm btn-primary\"><i class=\"icon-cursor\"></i></button>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PRICE -->
                            
                                <div class=\"accordion-item\">
                                    <h2 class=\"accordion-header\" id=\"panelsStayOpen-headingOne\">
                                        <button class=\"accordion-button\" type=\"button\" data-bs-toggle=\"collapse\"
                                            data-bs-target=\"#panelsStayOpen-collapseOne\" aria-expanded=\"true\"
                                            aria-controls=\"panelsStayOpen-collapseOne\">
                                            Category
                                        </button>
                                    </h2>
                                    <div id=\"panelsStayOpen-collapseOne\" class=\"accordion-collapse collapse show\"
                                        aria-labelledby=\"panelsStayOpen-headingOne\">
                                        <div class=\"accordion-body\">
                                            <div class=\"sidebar-widget shop-sidebar-border\">
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                        id=\"flexCheckDefault1\">
                                                    <label class=\"form-check-label\" for=\"flexCheckDefault1\">
                                                        Smartphone
                                                    </label>
                                                </div>
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                        id=\"flexCheckDefault2\">
                                                    <label class=\"form-check-label\" for=\"flexCheckDefault2\">
                                                        Tablets
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class=\"accordion-item\">
                                    <h2 class=\"accordion-header\" id=\"panelsStayOpen-headingTwo\">
                                        <button class=\"accordion-button\" type=\"button\"
                                            data-bs-toggle=\"collapse\" data-bs-target=\"#panelsStayOpen-collapseTwo\"
                                            aria-expanded=\"true\" aria-controls=\"panelsStayOpen-collapseTwo\">
                                            Brand
                                        </button>
                                    </h2>
                                    <div id=\"panelsStayOpen-collapseTwo\" class=\"accordion-collapse collapse show\"
                                        aria-labelledby=\"panelsStayOpen-headingTwo\">
                                        <div class=\"accordion-body\">
                                            <div class=\"sidebar-widget shop-sidebar-border\">
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                        id=\"flexCheckDefault1\">
                                                    <label class=\"form-check-label\" for=\"flexCheckDefault1\">
                                                        Apple
                                                    </label>
                                                </div>
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                        id=\"flexCheckDefault2\">
                                                    <label class=\"form-check-label\" for=\"flexCheckDefault2\">
                                                        Samsung
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class=\"accordion-item\">
                                    <h2 class=\"accordion-header\" id=\"panelsStayOpen-headingThree\">
                                        <button class=\"accordion-button\" type=\"button\"
                                            data-bs-toggle=\"collapse\" data-bs-target=\"#panelsStayOpen-collapseThree\"
                                            aria-expanded=\"true\" aria-controls=\"panelsStayOpen-collapseThree\">
                                            Color
                                        </button>
                                    </h2>
                                    <div id=\"panelsStayOpen-collapseThree\" class=\"accordion-collapse collapse show\"
                                        aria-labelledby=\"panelsStayOpen-headingThree\">
                                        <div class=\"accordion-body\">
                                            <div class=\"sidebar-widget shop-sidebar-border\">
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                        id=\"flexCheckDefault1\">
                                                    <label class=\"form-check-label\" for=\"flexCheckDefault1\">
                                                        Black
                                                    </label>
                                                </div>
                                                <div class=\"form-check\">
                                                    <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                        id=\"flexCheckDefault2\">
                                                    <label class=\"form-check-label\" for=\"flexCheckDefault2\">
                                                        Blue
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            
                            </div>
                            <!-- END ACCORDION -->


                        </div>
                    </div>
                    <!-- END SIDE BAR -->


                    <!-- MOBILE FILTER OFFCANVAS -->
                      <div class=\"offcanvas offcanvas-start\" tabindex=\"-1\" id=\"offcanvasExample\" aria-labelledby=\"offcanvasExampleLabel\">
                        <div class=\"offcanvas-header\">
                          <h5 class=\"offcanvas-title\" id=\"offcanvasExampleLabel\">Filter</h5>
                          <button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\">Done</button>
                        </div>
                        <div class=\"offcanvas-body\">
                            <div class=\"sidebar-wrapper sidebar-wrapper-mrg-right mt-0\">

                                <!-- ACCORDION -->
                                <div class=\"accordion\" id=\"accordionPanelsStayOpenExample\">
    
                                    <!-- PRICE -->
                                    <div class=\"accordion-item price\">
                                        <h2 class=\"accordion-header\" id=\"panelsStayOpen-headingOne1\">
                                            <button class=\"accordion-button\" type=\"button\" data-bs-toggle=\"collapse\"
                                                data-bs-target=\"#panelsStayOpen-collapseOne1\" aria-expanded=\"true\"
                                                aria-controls=\"panelsStayOpen-collapseOne1\">
                                                Price
                                            </button>
                                        </h2>
                                        <div id=\"panelsStayOpen-collapseOne1\" class=\"accordion-collapse collapse show\"
                                            aria-labelledby=\"panelsStayOpen-headingOne1\">
                                            <div class=\"accordion-body\">
                                                <div class=\"input-group mb-3\">
                                                    <span class=\"input-group-text\" id=\"basic-addon1\">OMR</span>
                                                    <input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"50\" aria-label=\"Username\">
                                                    <span class=\"input-group-text\">OMR</span>
                                                    <input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"100\" aria-label=\"Server\">
                                                    <button type=\"button\" class=\"btn btn-sm btn-primary\"><i class=\"icon-cursor\"></i></button>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PRICE -->
    
                                    <div class=\"accordion-item\">
                                        <h2 class=\"accordion-header\" id=\"panelsStayOpen-headingOne\">
                                            <button class=\"accordion-button\" type=\"button\" data-bs-toggle=\"collapse\"
                                                data-bs-target=\"#panelsStayOpen-collapseOne\" aria-expanded=\"true\"
                                                aria-controls=\"panelsStayOpen-collapseOne\">
                                                Category
                                            </button>
                                        </h2>
                                        <div id=\"panelsStayOpen-collapseOne\" class=\"accordion-collapse collapse show\"
                                            aria-labelledby=\"panelsStayOpen-headingOne\">
                                            <div class=\"accordion-body\">
                                                <div class=\"sidebar-widget shop-sidebar-border\">
                                                    <div class=\"form-check\">
                                                        <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                            id=\"flexCheckDefault1\">
                                                        <label class=\"form-check-label\" for=\"flexCheckDefault1\">
                                                            Smartphone
                                                        </label>
                                                    </div>
                                                    <div class=\"form-check\">
                                                        <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                            id=\"flexCheckDefault2\">
                                                        <label class=\"form-check-label\" for=\"flexCheckDefault2\">
                                                            Tablets
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class=\"accordion-item\">
                                        <h2 class=\"accordion-header\" id=\"panelsStayOpen-headingTwo\">
                                            <button class=\"accordion-button\" type=\"button\"
                                                data-bs-toggle=\"collapse\" data-bs-target=\"#panelsStayOpen-collapseTwo\"
                                                aria-expanded=\"false\" aria-controls=\"panelsStayOpen-collapseTwo\">
                                                Brand
                                            </button>
                                        </h2>
                                        <div id=\"panelsStayOpen-collapseTwo\" class=\"accordion-collapse collapse show\"
                                            aria-labelledby=\"panelsStayOpen-headingTwo\">
                                            <div class=\"accordion-body\">
                                                <div class=\"sidebar-widget shop-sidebar-border\">
                                                    <div class=\"form-check\">
                                                        <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                            id=\"flexCheckDefault1\">
                                                        <label class=\"form-check-label\" for=\"flexCheckDefault1\">
                                                            Apple
                                                        </label>
                                                    </div>
                                                    <div class=\"form-check\">
                                                        <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                            id=\"flexCheckDefault2\">
                                                        <label class=\"form-check-label\" for=\"flexCheckDefault2\">
                                                            Samsung
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class=\"accordion-item\">
                                        <h2 class=\"accordion-header\" id=\"panelsStayOpen-headingThree\">
                                            <button class=\"accordion-button\" type=\"button\"
                                                data-bs-toggle=\"collapse\" data-bs-target=\"#panelsStayOpen-collapseThree\"
                                                aria-expanded=\"false\" aria-controls=\"panelsStayOpen-collapseThree\">
                                                Color
                                            </button>
                                        </h2>
                                        <div id=\"panelsStayOpen-collapseThree\" class=\"accordion-collapse collapse show\"
                                            aria-labelledby=\"panelsStayOpen-headingThree\">
                                            <div class=\"accordion-body\">
                                                <div class=\"sidebar-widget shop-sidebar-border\">
                                                    <div class=\"form-check\">
                                                        <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                            id=\"flexCheckDefault1\">
                                                        <label class=\"form-check-label\" for=\"flexCheckDefault1\">
                                                            Black
                                                        </label>
                                                    </div>
                                                    <div class=\"form-check\">
                                                        <input class=\"form-check-input\" type=\"checkbox\" value=\"\"
                                                            id=\"flexCheckDefault2\">
                                                        <label class=\"form-check-label\" for=\"flexCheckDefault2\">
                                                            Blue
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
    
                                </div>
                                <!-- END ACCORDION -->
    
    
                            </div>
                        </div>
                      </div>
                    <!-- END MOBILE FILTER OFFCANVAS -->

                </div>
            </div>
        </section>
        <!-- END SHOP PAGE -->";
        // line 440
        $this->loadTemplate("shop/layout/footer.twig", "shop/shop.twig", 440)->display($context);
    }

    public function getTemplateName()
    {
        return "shop/shop.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  474 => 440,  161 => 128,  127 => 97,  80 => 53,  64 => 40,  60 => 39,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "shop/shop.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\shop\\shop.twig");
    }
}
