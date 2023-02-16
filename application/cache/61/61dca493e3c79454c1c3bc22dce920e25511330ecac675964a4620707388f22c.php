<?php

/* shop/about_us.twig */
class __TwigTemplate_1af0d4ca3102e8a1d4ce31e2ae738330284941e091f1dd3264ed09e243f721f6 extends Twig_Template
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
        $this->loadTemplate("shop/layout/header.twig", "shop/about_us.twig", 1)->display($context);
        // line 2
        echo "
        <!-- MOBILE VIEW SEARCH AREA -->
        <div class=\"mobile-view-search p-3 pt-0 d-block d-md-block d-lg-block d-xl-none\">
            <div class=\"input-group input-group-sm\">
                <input type=\"text\" class=\"form-control shadow-none\" placeholder=\"What are you looking for?\"
                    aria-label=\"Recipient's username\" aria-describedby=\"button-addon2\">
                <button class=\"btn btn-outline-secondary\" type=\"button\" id=\"button-addon2\"><i
                        class=\"icon-magnifier\"></i></button>
            </div>
        </div>
        <!-- END MOBILE VIEW SEARCH AREA -->

        <!-- Breadcrumb-area -->
        <div class=\"breadcrumb-area bg-gray\">
            <div class=\"container\">
                <div class=\"breadcrumb-content text-center\">
                    <ul>
                        <li><a href=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "index\">Home</a></li>
                        <li class=\"active\">About us</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-area -->


        <!-- ABOUT -->
        <section class=\"about-us-area pt-120 pb-120\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-lg-3 col-md-3\">
                        <div class=\"about-us-logo\">
                            <img src=\"assets/shop/images/logo/mbay.svg\" alt=\"logo\">
                        </div>
                    </div>
                    <div class=\"col-lg-9 col-md-9\">
                        <div class=\"about-us-content\">
                            <h3>Introduce</h3>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END ABOUT -->

        <!-- SERVICE -->
        <div class=\"service-area pb-120\">
            <div class=\"container\">
                <div class=\"service-wrap-border service-wrap-padding-3\">
                    <div class=\"row\">
                        <div class=\"col-lg-3 col-md-6 col-sm-6 col-12 service-border-1\">
                            <div class=\"single-service-wrap-2 mb-30\">
                                <div class=\"service-icon-2 icon-red\">
                                    <i class=\"icon-cursor\"></i>
                                </div>
                                <div class=\"service-content-2\">
                                    <h3>Free Shipping</h3>
                                    <p>Oders over \$99</p>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-lg-3 col-md-6 col-sm-6 col-12 service-border-1 service-border-1-none-md\">
                            <div class=\"single-service-wrap-2 mb-30\">
                                <div class=\"service-icon-2 icon-red\">
                                    <i class=\"icon-refresh \"></i>
                                </div>
                                <div class=\"service-content-2\">
                                    <h3>90 Days Return</h3>
                                    <p>For any problems</p>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-lg-3 col-md-6 col-sm-6 col-12 service-border-1\">
                            <div class=\"single-service-wrap-2 mb-30\">
                                <div class=\"service-icon-2 icon-red\">
                                    <i class=\"icon-credit-card \"></i>
                                </div>
                                <div class=\"service-content-2\">
                                    <h3>Secure Payment</h3>
                                    <p>100% Guarantee</p>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-lg-3 col-md-6 col-sm-6 col-12\">
                            <div class=\"single-service-wrap-2 mb-30\">
                                <div class=\"service-icon-2 icon-red\">
                                    <i class=\"icon-earphones \"></i>
                                </div>
                                <div class=\"service-content-2\">
                                    <h3>24h Support</h3>
                                    <p>Dedicated support</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SERVICE -->";
        // line 108
        $this->loadTemplate("shop/layout/footer.twig", "shop/about_us.twig", 108)->display($context);
    }

    public function getTemplateName()
    {
        return "shop/about_us.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 108,  40 => 19,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "shop/about_us.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\shop\\about_us.twig");
    }
}
