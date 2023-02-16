<?php

/* shop/contact.twig */
class __TwigTemplate_7a32399c0e0fd64428db3eff879dc699e74ad451f37e60a00e0f2944b75f6003 extends Twig_Template
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
        $this->loadTemplate("shop/layout/header.twig", "shop/contact.twig", 1)->display($context);
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
                        <li class=\"active\">Contact us</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-area -->

        <!-- CONTACT -->
        <section class=\"contact-area pt-120 pb-120\">
            <div class=\"container\">
                <div class=\"contact-info-wrap-3 pb-85\">
                    <h3>contact info</h3>
                    <div class=\"row\">

                        <div class=\"col-lg-6 col-md-4\">
                            <div class=\"single-contact-info-3 text-center mb-30\">
                                <i class=\"icon-location-pin \"></i>
                                <h4>Location</h4>
                                <p>Seeb, Muscat</p>
                            </div>
                        </div>
                        <div class=\"col-lg-6 col-md-4\">
                            <div class=\"single-contact-info-3 text-center mb-30\">
                                <i class=\"fa-brands fa-whatsapp\"></i>
                                <h4>WhatsApp Shoping</h4>
                                <p><a href=\"https://api.whatsapp.com/send?phone=+96871010201&text=Hi 👋,%0aI'm interested in buying *Apple iPhone 14 Pro*\" target=\"_blank\" title=\"Mbay WhatsApp Shoping\">+968 9551 7939</a></p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- END CONTACT -->";
        // line 45
        $this->loadTemplate("shop/layout/footer.twig", "shop/contact.twig", 45)->display($context);
    }

    public function getTemplateName()
    {
        return "shop/contact.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 45,  29 => 8,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "shop/contact.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\shop\\contact.twig");
    }
}
