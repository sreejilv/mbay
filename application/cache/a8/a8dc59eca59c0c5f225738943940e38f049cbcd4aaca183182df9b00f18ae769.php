<?php

/* shop/layout/header.twig */
class __TwigTemplate_d9d5888f99be9540a6b1ef362a45e5578368b42fedad2de134ce989c2f98c56d extends Twig_Template
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
        echo "<!doctype html>
<html class=\"no-js\" lang=\"en\">

<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">
    <meta name=\"robots\" content=\"noindex, follow\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no\" />

    <title>Mbay Online Shopping</title>
    <meta name=\"description\" content=\"Free Web tutorials\">
    <meta name=\"keywords\" content=\"HTML, CSS, JavaScript\">


    <!-- Favicon -->
    <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"assets/shop/images/favicon/favicon-32x32.png\">
    <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"assets/shop/images/favicon/favicon-16x16.png\">

    <!-- BASE CSS -->
    <link rel=\"stylesheet\" href=\"assets/shop/css/vendor/bootstrap.min.css\" media=\"all\">
    <!-- <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css\"> -->
    <link rel=\"stylesheet\" href=\"assets/shop/css/vendor/simple-line-icons.css\" media=\"all\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/style.css\" media=\"all\">
    <!-- <link rel=\"stylesheet\" href=\"assets/shop/css/style_rtl.css\"> -->
    <link rel=\"stylesheet\" href=\"assets/shop/css/custom_style.css\">
    <!-- <link rel=\"stylesheet\" href=\"assets/shop/css/custom_style_rtl.css\"> -->


    <!-- PAGE CSS -->
    <link rel=\"stylesheet\" href=\"assets/shop/css/plugins/slick.css\" media=\"all\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/plugins/animate.css\" media=\"all\">
    <link rel=\"stylesheet\" href=\"assets/shop/css/plugins/jquery-ui.css\" media=\"all\">
    

</head>

<body>
<div class=\"main-wrapper bg-gray-9\">

        <!-- HEADER -->
        <header class=\"header-area\">
            <div class=\"container\">
                <div class=\"header-large-device\">
                    <div class=\"header-top header-top-ptb-2 border-bottom-1\">
                        <div class=\"row align-items-center justify-content-center\">

                            <div class=\"col-xl-2 col-lg-2\">
                                <div class=\"logo\">
                                    <a href=\"";
        // line 49
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "index\"><img src=\"assets/shop/images/logo/mbay.svg\" alt=\"logo\"></a>
                                </div>
                            </div>
                            <div class=\"col-xl-6 col-lg-2\">
                                <!-- PC VIEW SEARCH AREA -->
                                <div class=\"mobile-view-search d-none d-md-none d-lg-none d-xl-block\">
                                    <div class=\"input-group input-group-sm\">
                                        <input type=\"text\" class=\"form-control\" placeholder=\"What are you looking for?\"
                                            aria-label=\"Recipient's username\" aria-describedby=\"button-addon2\">
                                        <button class=\"btn btn-outline-secondary\" type=\"button\" id=\"button-addon2\"><i
                                                class=\"icon-magnifier\"></i></button>
                                    </div>
                                </div>
                                <!-- END PC VIEW SEARCH AREA -->
                            </div>
                            <div class=\"col-xl-4 col-lg-5\">
                                <div class=\"header-top-right\">
                                    <div class=\"header-login-regi\">
                                        <a href=\"";
        // line 67
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "login-site\"><i class=\"icon-user\"></i> Log In / Register</a>
                                    </div>
                                    <div class=\"header-cart-2\">
                                        <a class=\"cart-active\" href=\"";
        // line 70
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "cart\"><i class=\"icon-basket-loaded\"></i> <span
                                                class=\"black\">02</span> \$264.50</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"header-bottom\">
                        <div class=\"row align-items-center\">
                            <div class=\"col-12\">
                                <div
                                    class=\"main-menu main-menu-padding-2 main-menu-center main-menu-font-width-400 main-menu-lh-1\">
                                    <nav>
                                        <ul>
                                            <li><a href=\"";
        // line 84
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "shop\">Smartphone </a></li>
                                            <li><a href=\"";
        // line 85
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "shop\">Tablets </a></li>
                                            <li><a href=\"";
        // line 86
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "shop\">Accessories </a></li>
                                            <li><a href=\"";
        // line 87
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "shop\">Wearable Devices </a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"header-small-device small-device-ptb-1\">
                    <div class=\"row align-items-center\">
                        <div class=\"col-6\">
                            <div class=\"mobile-logo\">
                                <a href=\"";
        // line 99
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "index\">
                                    <img alt=\"\" src=\"assets/shop/images/logo/mbay.svg\">
                                </a>
                            </div>
                        </div>
                        <div class=\"col-6\">
                            <div class=\"header-action header-action-flex\">
                                <div class=\"same-style-2\">
                                    <a href=\"#\"><i class=\"icon-user\"></i></a>
                                </div>
                                <div class=\"same-style-2 header-cart\">
                                    <a class=\"cart-active\" href=\"#\">
                                        <i class=\"icon-basket-loaded\"></i><span class=\"pro-count black\">02</span>
                                    </a>
                                </div>
                                <div class=\"same-style-2 main-menu-icon\">
                                    <a class=\"mobile-header-button-active\" href=\"#\"><i class=\"icon-menu\"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER -->

        <!-- MOBILE MENU -->
        <div class=\"mobile-header-active mobile-header-wrapper-style\">
            <div class=\"clickalbe-sidebar-wrap\">
                <a class=\"sidebar-close\"><i class=\"icon_close\"></i></a>
                <div class=\"mobile-header-content-area\">

                    <div class=\"mobile-menu-wrap mobile-header-padding-border-2\">
                        <!-- mobile menu start -->
                        <nav>
                            <ul class=\"mobile-menu\">
                                <li><a href=\"#\">Home</a></li>
                                <li><a href=\"#\">About</a></li>
                                <li class=\"menu-item-has-children\"><a href=\"#\">Shop</a>
                                    <ul class=\"dropdown\">
                                        <li><a href=\"#\">Smartphone </a></li>
                                    </ul>
                                </li>
                                <li><a href=\"#\">Contact us</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu end -->
                    </div>
                    <div class=\"mobile-social-icon\">
                        <a class=\"facebook\" href=\"#\"><i class=\"icon-social-facebook\"></i></a>
                        <a class=\"instagram\" href=\"#\"><i class=\"icon-social-instagram\"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MOBILE MENU -->

        <!-- MOBILE VIEW SEARCH AREA -->
        <div class=\"mobile-view-search p-3 pt-0 d-block d-md-block d-lg-block d-xl-none\">
            <div class=\"input-group input-group-sm\">
                <input type=\"text\" class=\"form-control\" placeholder=\"What are you looking for?\"
                    aria-label=\"Recipient's username\" aria-describedby=\"button-addon2\">
                <button class=\"btn btn-outline-secondary\" type=\"button\" id=\"button-addon2\"><i
                        class=\"icon-magnifier\"></i></button>
            </div>
        </div>
        <!-- END MOBILE VIEW SEARCH AREA -->
    </div>";
    }

    public function getTemplateName()
    {
        return "shop/layout/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  140 => 99,  125 => 87,  121 => 86,  117 => 85,  113 => 84,  96 => 70,  90 => 67,  69 => 49,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "shop/layout/header.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\shop\\layout\\header.twig");
    }
}
